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
    <v-card class="p-3">
       <v-container>
          <v-toolbar flat>
            <h2 class="mt-4">Meses</h2>
            <v-spacer></v-spacer>
            <v-row>
              <v-col align="end">
                <v-btn
                  rounded
                  @click="addRecord()"
                  class="mb-0 mt-3 btn-normal no-uppercase"
                  title="Agregar"
                >
                  Agregar
                </v-btn>
              </v-col>
              <v-col xs="6" sm="6" md="6" class="d-none d-md-block d-lg-block">
                <v-text-field
                  class="mt-3"
                  outlined
                  dense
                  label="Buscar"
                  type="text"
                  v-model="options.search"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-toolbar>
        </v-container>
      <v-data-table
        v-model="selected"
        :single-select="false"
        show-select
        :search="options.search"
        :headers="headers"
        :items="recordsFiltered"
        :options.sync="options"
        :loading="loading"
        item-key="id"
        sort-by="id"
        :footer-props="{ 'items-per-page-options': [15, 30, 50, 100] }"
      >
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small class="mr-2" @click="deleteItem(item)">
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-icon small class="mr-2" @click="initialize"> mdi-refresh </v-icon>
        </template>
      </v-data-table>
    </v-card>

    <v-dialog v-model="dialog" max-width="600px" persistent>
      <v-card class="flexcard" height="100%">
        <v-card-title>
          <h1 class="mx-auto pt-3 mb-3 text-center black-secondary">
            {{ formTitle }}
          </h1>
        </v-card-title>

        <v-card-text>
          <v-container>
            <!-- Form -->
            <v-row class="pt-3">
              
        <!-- month_name -->
            <v-col cols="12" sm="12" md="12">
                <base-input
                label="Mes"
                v-model="$v.editedItem.month_name.$model"
                :validation="$v.editedItem.month_name"
                validationTextType="none"
                :validationsInput="{
                    required: true,
                    minLength: true,
                }"
                />
            </v-col>
        <!-- month_name -->

        
            </v-row>
            <!-- Form -->
            <v-row>
              <v-col align="center">
                <v-btn
                  color="btn-normal no-uppercase mt-3"
                  rounded
                  @click="save"
                >
                  Guardar
                </v-btn>
                <v-btn
                  color="btn-normal-close no-uppercase mt-3"
                  rounded
                  @click="close"
                >
                  Cancelar
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogDelete" max-width="400px">
      <v-card class="h-100">
        <v-container>
          <h1 class="black-secondary text-center mt-3 mb-3">
            {{
              selected.length > 0 ? "Eliminar registros" : "Eliminar registro"
            }}
          </h1>
          <v-row>
            <v-col align="center">
              <v-btn
                color="btn-normal no-uppercase mt-3 mb-3 pr-5 pl-5 mx-auto"
                rounded
                @click="deleteItemConfirm"
                >Confirmar</v-btn
              >
              <v-btn
                color="btn-normal-close no-uppercase mt-3 mb-3"
                rounded
                @click="closeDelete"
              >
                Cancelar
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import monthApi from "../apis/monthApi";

import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      search: "",
      selected: [],
      dialog: false,
      dialogDelete: false,
      headers: [
        
		{ text: "MES", value: "month_name" },
        { text: "ACCIONES", value: "actions", sortable: false },
      ],
      records: [],
      recordsFiltered: [],
      editedIndex: -1,
      title: "MES",
      totalItems: 0,
      options: {},
      editedItem: {
        		month_name: "",
      },
      defaultItem: {
        		month_name: "",
      },
      selectedTab: 0,
      loading: false,
      debounce: 0,
      textAlert: "",
      alertEvent: "success",
      showAlert: false,
      redirectSessionFinished: false,
      alertTimeOut: 0,
      
    };
  },

  watch: {
    options: {
      handler() {
        this.getDataFromApi();
      },
      deep: true,
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  // Validations
  validations: {
    editedItem: {
      month_name: {
		required,
		minLength: minLength(1),
},
    },
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo registro" : "Editar registro";
    },
  },

  watch: {
    options: {
      handler() {
        this.getDataFromApi();
      },
      deep: false,
      dirty: false,
    },
    dialog(val) {
      val || this.close();
    },
    dialogBlock(val) {
      val || this.closeBlock();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;
      this.$v.$reset();
      this.records = [];
      this.recordsFiltered = [];

      let requests = [
        this.getDataFromApi(),
        
      ];

      const responses = await Promise.all(requests).catch((error) => {
        this.updateAlert(true, "No fue posible obtener el registro.", "fail");

        this.redirectSessionFinished = lib.verifySessionFinished(error.response.status, 419);
      });

      if (responses) {
        
      }

      this.loading = false;
    },

    editItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.selectedTab = 0;
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async save() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.updateAlert(true, "Campos obligatorios.", "fail");
        return;
      }

      if (this.editedIndex > -1) {
        const edited = Object.assign(
          this.recordsFiltered[this.editedIndex],
          this.editedItem
        );

        const { data } = await monthApi
          .put(`/${edited.id}`, edited)
          .catch((error) => {
            this.updateAlert(true, "No fue posible actualizar el registro.", "fail");

            this.redirectSessionFinished = lib.verifySessionFinished(error.response.status, 419);
          });

        if (data.success) {
            this.updateAlert(true, data.message, "success");
        }
      } else {
        //Creating user
        const { data } = await monthApi
          .post(null, this.editedItem)
          .catch((error) => {
            this.updateAlert(true, "No fue posible crear el registro.", "fail");

            this.redirectSessionFinished = lib.verifySessionFinished(error.response.status, 419);
          });

        if (data.success) {
          this.updateAlert(true, data.message, "success");
        }
      }

      this.close();
      this.initialize();
      return;
    },

    deleteItem(item = null) {
      console.log(item);
      if (item) {
        this.editedIndex = this.recordsFiltered.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.selected = [];
      }

      this.dialogDelete = true;
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async deleteItemConfirm() {
      const { data } = await monthApi
        .delete(null, {
          params: {
            selected: this.selected,
            id: this.editedItem.id,
          }
        })
        .catch((error) => {
            this.updateAlert(true, "No fue posible eliminar el registro.", "fail");

            this.redirectSessionFinished = lib.verifySessionFinished(error.response.status, 419);
          this.close();
        });

      if (data.success) {
        this.updateAlert(true, data.message, "success");
      }

      this.initialize();
      this.closeDelete();
    },

    getDataFromApi() {
      this.loading = true;
      this.records = [];
      this.recordsFiltered = [];

      //debounce
      clearTimeout(this.debounce);
      this.debounce = setTimeout(async () => {
        const { data } = await monthApi
          .get(null, {
            params: this.options,
          })
          .catch((error) => {
            this.updateAlert(true, "No fue posible obtener los registros.", "fail");
          });

        this.records = data.records;
        this.recordsFiltered = data.records;
        this.total = data.total;
        this.loading = false;
      }, 500);
    },

    addRecord() {
      this.dialog = true;
      this.editedIndex = -1;
      this.selectedTab = 0;
      this.editedItem = Object.assign({}, this.defaultItem);
      this.$v.$reset();
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },
  },
};
</script>
