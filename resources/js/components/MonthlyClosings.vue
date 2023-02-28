<template>
  <div data-app>
    <alert-time-out
      :redirect="redirectSessionFinished"
      @redirect="updateTimeOut($event)"
    />
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    />
    <v-data-table
      :headers="headers"
      :items="recordsFiltered"
      sort-by="active"
      class="elevation-3 shadow p-3 mt-3"
    >
      <template v-slot:top>
        <v-toolbar flat>
            <h2 class="mt-4">Bitácora de cierres mensuales</h2>
          <v-spacer></v-spacer>
        </v-toolbar>
      </template>
      <!-- <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template> -->
      <template v-slot:no-data>
        <a
          href="#"
          class="btn btn-normal-secondary no-decoration"
          @click="initialize"
        >
          Reiniciar
        </a>
      </template>
    </v-data-table>
  </div>
</template>

<script>
// import yearApi from "../../apis/yearApi";
// import monthApi from "../../apis/monthApi";
import { format } from "date-fns";
import esEsLocale from "date-fns/locale/es";
import monthlyClosingApi from "../apis/monthlyClosingApi";
// import lib from "../../libs/function";
import { required } from "vuelidate/lib/validators";

export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "AÑO", value: "year_name" },
      { text: "FECHA  DE CIERRE", value: "closing_date" },
    ],
    records: [],
    recordsFiltered: [],
    editedIndex: -1,
    editedItem: {
      year_name: "",
      closing_date: "",
    },
    defaultItem: {
      year_name: "",
      closing_date: "",
    },
    textAlert: "",
    alertEvent: "success",
    showAlert: false,
    redirectSessionFinished: false,
  }),

  // Validations
  validations: {
    editedItem: {
      year_name: {
        required,
      },
      closing_date: {
        required,
      },
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.records = [];
      this.recordsFiltered = [];

      let requests = [monthlyClosingApi.get()];
      let responses = await Promise.all(requests).catch((error) => {
        this.updateAlert(true, "No fue posible obtener los registros.", "fail");
        this.redirectSessionFinished = lib.verifySessionFinished(
          error.response.status,
          401
        );
      });

      if (responses && responses[0].data.message == "success") {
        this.records = responses[0].data.monthlyClosings;

        this.recordsFiltered = this.records;
        this.setDate();
      }
    },

    setDate() {
      this.recordsFiltered.forEach((closings) => {
        closings.closing_date = format(
          new Date(closings.closing_date),
          "EEEE, dd MMMM, yyyy hh:mm a",
          {
            locale: esEsLocale,
          }
        );
      });
    },

    searchValue() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";
          for (let i = 0; i < record.closing_date.length; i++) {
            searchConcat += record.closing_date[i].toUpperCase();
            if (
              searchConcat === this.search.toUpperCase() &&
              !this.recordsFiltered.some((rec) => rec == record)
            ) {
              this.recordsFiltered.push(record);
            }
          }
        });
        return;
      }

      this.recordsFiltered = this.records;
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },

    updateTimeOut(event) {
      this.redirectSessionFinished = event;
    },
  },
};
</script>

