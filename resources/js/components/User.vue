<template>
  <div data-app>
    <alert-time-out 
    :redirect="redirectSessionFinished" 
    @redirect="updateTimeOut($event)" />

    <alert 
    :text="textAlert" 
    :event="alertEvent" 
    :show="showAlert" 
    @show-alert="updateAlert($event)" class="mb-2" />

    <v-data-table 
    :headers="headers" 
    :loading="loading" 
    :items="recordsFiltered" 
    :search="search" 
    :options.sync="options"
    :server-items-length="total" 
    :footer-props="{ itemsPerPageOptions: [20] }" 
    :items-per-page="take"
    @update:options="updatePagination" 
    :page.sync="actualPage" 
    item-key="id" sort-by="user_name"
      class="elevation-3 shadow p-3 mt-3">
  <template v-slot:top>
    <v-toolbar flat>
      <h2 class="mt-4">Usuarios</h2>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="600px" persistent>
        <template v-slot:activator="{ on, attrs }">
          <v-row>
            <v-col align="right">
              <v-btn class="mb-2 btn-normal no-uppercase" v-bind="attrs" v-on="on" :disabled="loading != false"
                rounded @click="newUser()">
                Agregar
              </v-btn>
            </v-col>
            <v-col xs="6" sm="6" md="6" class="d-none d-md-block d-lg-block">
              <v-text-field dense label="Buscar" outlined type="text" v-model="search"
                @input="searchValue()"></v-text-field>
            </v-col>
          </v-row>
        </template>
        <v-card class="flexcard auth" height="100%">
          <v-card-title>
            <h1 class="mx-auto pt-3 mb-3 text-center black-secondary">
              {{ formTitle }}
            </h1>
          </v-card-title>

      <v-card-text>
        <v-container>
          <!-- Form -->
          <v-row>
            <!-- Full Name -->
            <v-col cols="12" sm="6" md="12">
              <base-input label="Nombre" v-model="$v.editedItem.name.$model" :validation.sync="$v.editedItem.name"
                validationTextType="default" :validationsInput="{
                  required: true,
                  minLength: true,
                  maxLength: true,
                }" />
            </v-col>

            <!-- User Name -->
            <v-col cols="12" sm="6" md="6">
              <base-input label="Usuario" v-model="$v.editedItem.user_name.$model"
                :validation.sync="$v.editedItem.user_name" validationTextType="default" :validationsInput="{
                  required: true,
                  minLength: true,
                  maxLength: true,
                }" />
            </v-col>

            <!-- Job -->
            <v-col cols="12" sm="6" md="6">
              <base-input label="Cargo" v-model="$v.editedItem.job_title.$model"
                :validation.sync="$v.editedItem.job_title" validationTextType="default" :validationsInput="{
                  required: true,
                  minLength: true,
                  maxLength: true,
                }" />
            </v-col>

            <!-- Cellphone -->
            <v-col cols="12" xs="12" sm="12" md="6">
              <base-input label="Celular" v-model.trim="$v.editedItem.phone.$model"
                :validation.sync="$v.editedItem.phone" v-mask="'####-####'" validationTextType="only-numbers"
                :validationsInput="{
                  required: true,
                  format: true,
                  minLength: false,
                  maxLength: false,
                }" />
            </v-col>

            <!-- Rol  -->
            <v-col cols="12" sm="6" md="6">
              <base-select label="Rol" v-model.trim="$v.editedItem.rol.$model" :items="roles"
                :validation="$v.editedItem.rol" />
            </v-col>
            <!-- Rol  -->
            <!-- Unidad organizativa  -->
            <v-col cols="12" sm="6" md="6">
              <base-select label="Unidad organizativa" v-model.trim="$v.editedItem.ou_name.$model"
                :items="organizationalUnits" item="ou_name" :validation="$v.editedItem.ou_name" />
            </v-col>
            <!-- Unidad organizativa  -->
            <!-- E-mail -->
            <v-col cols="12" sm="6" md="6">
              <base-input label="Correo electrónico" v-model="$v.editedItem.email.$model"
                :validation.sync="$v.editedItem.email" validationTextType="none" :validationsInput="{
                  required: true,
                  email: true,
                }" />
            </v-col>
            <!-- E-mail -->
            <!-- Password -->
            <v-col cols="12" sm="6" md="6">
              <base-input label="Contraseña" v-model="$v.editedItem.password.$model"
                :validation.sync="$v.editedItem.password" validationTextType="none" :type="typePassword" :min="1"
                autocomplete="off" :validationsInput="{
                  required: true,
                  minLength: true,
                  maxnLength: true,
                  isValidPassword: false,
                  showPassword: true,
                }" @update-password="showPassword($event)" />
            </v-col>
            <!-- Password -->
          </v-row>
          <!-- Form -->
          <v-row>
            <v-col align="center">
              <v-btn color="btn-normal no-uppercase mt-3" rounded @click="save">
                Guardar
              </v-btn>
              <v-btn color="btn-normal-close no-uppercase mt-3" rounded @click="close">
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
            <h3 class="black-secondary text-center mt-3 mb-3">
              Eliminar registro
            </h3>
            <v-row>
              <v-col align="center">
                <v-btn color="btn-normal no-uppercase mt-3 mb-3 pr-5 pl-5 mx-auto" rounded
                  @click="deleteItemConfirm">Confirmar</v-btn>
                <v-btn color="btn-normal-close no-uppercase mt-3 mb-3" rounded @click="closeDelete">
                  Cancelar
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-dialog>
    </v-toolbar>
  </template>
  <template v-slot:[`item.actions`]="{ item }">
    <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
    <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
  </template>
  <template v-slot:no-data>
    <a href="#" class="btn btn-normal-secondary no-decoration" @click="initialize">
      Reiniciar
    </a>
  </template>
</v-data-table>
</div>
</template>

<script>
import roleApi from "../apis/roleApi";
import userApi from "../apis/userApi";
import organizationalUnitApi from "../apis/organizationalUnitApi";
import lib from "../libs/function";

import {
  required,
  minLength,
  maxLength,
  email,
  helpers,
} from "vuelidate/lib/validators";

export default {
  data() {
    return {
      search: "",
      loading: false,
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: "USUARIO", value: "user_name" },
        { text: "NOMBRE", value: "name" },
        { text: "CARGO", value: "job_title" },
        { text: "UNIDAD ORGANIZATIVA", value: "ou_name" },
        { text: "CELULAR", value: "phone" },
        { text: "ROL", value: "rol" },
        { text: "CORREO ELECTRÓNICO", value: "email" },
        { text: "ACCIONES", value: "actions", sortable: false },
      ],
      records: [],
      recordsFiltered: [],
      editedIndex: -1,
      skip: 0,
      take: 50,
      title: "Usuarios",
      numberItemsToAdd: 50,
      total: 50,
      loadMoreItems: false,
      options: {},
      actualPage: 1,
      editedItem: {
        name: "",
        user_name: "",
        job_title: "",
        phone: "",
        email: "",
        password: "",
        rol: "",
        ou_name: "",
      },
      defaultItem: {
        name: "",
        user_name: "",
        job_title: "",
        phone: "",
        email: "",
        password: "",
        rol: "",
        ou_name: "",
      },
      textAlert: "",
      alertEvent: "success",
      roles: [],
      organizationalUnits: [],
      redirectSessionFinished: false,
      showAlert: false,
      typePassword: "password",
    };
  },

  // Validations
  validations: {
    editedItem: {
      password: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(13),
        // isValidPassword: helpers.regex(
        //   "isValidPassword",
        //   /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{3,13}$/
        // ),
      },
      email: {
        required,
        email,
      },
      name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(500),
      },
      user_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(500),
      },
      ou_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(500),
      },
      job_title: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(500),
      },
      phone: {
        required,
        isValidNumber: helpers.regex("isValidNumber", /([0-9]{4}-[0-9]{4})/),
      },
      rol: {
        required,
      },
    },
  },

  // Validations
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo registro" : "Editar registro";
    },
  },

  watch: {
    options: {
      handler() {
        this.loadMore();
      },
      deep: false,
      dirty: false,
    },
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    /*dialogBlock(val) {
      val || this.closeBlock();
    },*/
  },

  created() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;
      //this.$v.$reset();
      this.records = [];
      this.recordsFiltered = [];

      let requests = [
        userApi.get(null, {
          params: { skip: 0, take: 200 },
        }),
        roleApi.get(),
        organizationalUnitApi.post(`allOrganizationalUnits`),
      ];

      const responses = await Promise.all(requests).catch((error) => {
        this.updateAlert(true, "No fue posible obtener el registros.", "fail");
        this.redirectSessionFinished = lib.verifySessionFinished(
          error.response.status,
          401
        );
      });

      this.records = responses[0].data.users;
      this.recordsFiltered = responses[0].data.users;
      this.total = responses[0].data.total;

      this.roles = responses[1].data.roles;
      this.organizationalUnits = responses[2].data.organizationalUnits;
      this.loading = false;
    },

    editItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    async deleteItemConfirm() {
      const res = await userApi
        .delete(`/${this.editedItem.id}`)
        .catch((error) => {
          this.updateAlert(
            true,
            "No fue posible eliminar el registros.",
            "fail"
          );
          this.close();
        });

      if (res.data.message == "success") {
        this.redirectSessionFinished = lib.verifySessionFinished(
          res.status,
          200
        );
        this.updateAlert(true, "Registro eliminado.", "success");
      } else {
        this.updateAlert(true, "No se pudo eliminar el registro.", "fail");
      }

      this.initialize();
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = this.defaultItem;
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.$nextTick(() => {
        this.editedItem = this.defaultItem;
        this.editedIndex = -1;
      });

      this.dialogDelete = false;
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

        const res = await userApi
          .put(`/${edited.id}`, edited)
          .catch((error) => {
            this.updateAlert(
              true,
              "No fue posible actualizar el registro.",
              "fail"
            );

            this.redirectSessionFinished = lib.verifySessionFinished(
              error.response.status,
              419
            );
          });

        if (res.data.message == "success") {
          this.redirectSessionFinished = lib.verifySessionFinished(
            res.status,
            200
          );
          this.updateAlert(true, "Registro actualizado.", "success");
        } else {
          this.updateAlert(true, res.data.message, "warning");
        }
      } else {
        //Creating user
        const res = await userApi.post(null, this.editedItem).catch((error) => {
          this.updateAlert(true, "No fue posible crear el registro.", "fail");
          this.close();
          this.redirectSessionFinished = lib.verifySessionFinished(
            error.response.status,
            419
          );
        });

        if (res.data.message == "success") {
          this.redirectSessionFinished = lib.verifySessionFinished(
            res.status,
            200
          );
          this.updateAlert(
            true,
            "Registro almacenado correctamente.",
            "success"
          );
        } else {
          this.updateAlert(true, res.data.message, "warning");
        }
      }

      this.close();
      this.initialize();
      return;
    },

    searchValue() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";

          for (let i = 0; i < record.user_name.length; i++) {
            searchConcat += record.user_name[i].toUpperCase();

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

    async loadMore() {
      if (this.actualPage == 1) {
        this.actualPage = 1;
        this.skip = 0;
        this.take = this.numberItemsToAdd;
      }
      const res = await userApi
        .get(null, {
          params: { skip: this.skip, take: this.take },
        })
        .catch((error) => {
          this.redirectSessionFinished = lib.verifySessionFinished(
            res.status,
            200
          );
          this.updateAlert(
            true,
            "Registro almacenado correctamente.",
            "success"
          );
        });

      this.records = res.data.users;
      this.recordsFiltered = res.data.users;

      this.search = "";

      this.$v.editedItem.rol.$model = "Enlace";
    },

    updatePagination(pagination) {
      if (pagination.page != 1) {
        // Si la página es distinta de 1, verifica los datos a tomar y quitar
        if (pagination.page <= this.actualPage) {
          //Si la página es menor que la actual, se está retrocediendo
          this.take = this.skip;
          this.skip = this.take - this.numberItemsToAdd;
        } else {
          //Sino, se está aumentando en la cantidad de usuarios por ver
          this.skip = this.take;
          this.take += this.numberItemsToAdd;
        }
      } else {
        //Si es igual a cero, es la vista inicial
        this.skip = 0;
        this.take = this.numberItemsToAdd;
      }
      this.actualPage = pagination.page;
    },

    newUser() {
      this.dialog = true;

      this.editedItem.rol = this.roles[0].name;
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },

    updateTimeOut(event) {
      this.redirectSessionFinished = event;
    },

    showPassword(e) {
      this.typePassword = e.show;
    },
  },
};
</script>
