<script>
import axios from "axios";
import TablePartners from "../components/TablePartners.vue";

export default {
  data() {
    return {
      partners: [],
      partner: {
        nazwa: "",
        adres: "",
        telefon: "",
        mail: "",
        nip: "",
        id: "",
      },
      error: "",
      title: "Dodaj kontrahenta",
      editMode: false,
    };
  },
  components: { TablePartners },
  methods: {
    async fetchPartners() {
      await axios({
        method: "get",
        url: "http://localhost/sensonics/src/api/partners/api.php?action=loadpartners",
      })
        .then((res) => {
          this.partners = res.data;
        })
        .catch((err) => {
          console.log(err.message);
        });
    },
    async onSubmit() {
      if (this.validateForm()) {
        await axios({
          method: "post",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          url: "http://localhost/sensonics/src/api/partners/api.php?action=addpartner",
          data: this.partner,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }

      this.fetchPartners();
      this.clearForm();
    },
    async onDelete(id) {
      await axios
        .delete(
          `http://localhost/sensonics/src/api/partners/api.php?action=deletepartner&id=${id}`
        )
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err.message);
        });
      this.fetchPartners();
    },
    onEdit(data) {
      (this.partner.nazwa = data.nazwa),
        (this.partner.adres = data.adres),
        (this.partner.telefon = data.telefon.toString()),
        (this.partner.mail = data.mail),
        (this.partner.nip = data.nip.toString());
      this.partner.id = data.id.toString();

      this.editMode = true;
      this.title = "Edytuj kontrahenta";
    },
    async editPartner() {
      if (this.validateForm()) {
        await axios({
          method: "post",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          url: `http://localhost/sensonics/src/api/partners/api.php?action=editpartner&id=${this.partner.id}`,
          data: this.partner,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }
      this.editMode = false;
      this.title = "Dodaj kontrahenta";
      this.fetchPartners();
      this.clearForm();
    },
    validateForm() {
      this.error = "";
      setTimeout(() => {
        this.error = "";
      }, 5000);

      if (
        !this.partner.nazwa ||
        !this.partner.adres ||
        !this.partner.telefon ||
        !this.partner.mail ||
        !this.partner.nip
      ) {
        this.error = "Nie wszystkie pola zostały uzupełnione.";
        return false;
      }
      if (
        !this.partner.mail.match(
          /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
      ) {
        this.error = "Niepoprawny adres email.";
        return false;
      }
      if (
        !this.partner.telefon.match(
          /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{3})/
        )
      ) {
        this.error = "Niepoprawny numer telefonu.";
        return false;
      }
      if (!this.partner.nip.match(/^[0-9]{10}$/)) {
        this.error = "Niepoprawny numer NIP.";
        return false;
      }

      return true;
    },
    clearForm() {
      (this.partner.nazwa = ""),
        (this.partner.adres = ""),
        (this.partner.telefon = ""),
        (this.partner.mail = ""),
        (this.partner.nip = "");
    },
  },
  created() {
    this.fetchPartners();
  },
};
</script>

<template>
  <div>
    <TablePartners @delete="onDelete" @edit="onEdit" :data="partners" />
    <form
      action=""
      @submit.prevent="!this.editMode ? onSubmit() : editPartner()"
    >
      <h3>{{ title }}</h3>
      <div class="form-elem">
        <label for="nazwa">Nazwa:</label>
        <input
          type="text"
          name="nazwa"
          v-model="partner.nazwa"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="adres">Adres:</label>
        <input
          type="text"
          name="adres"
          v-model="partner.adres"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="telefon">Telefon:</label>
        <input
          type="text"
          name="telefon"
          v-model="partner.telefon"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="mail">Adres email:</label>
        <input
          type="text"
          name="mail"
          v-model="partner.mail"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="nip">NIP:</label>
        <input
          type="text"
          name="nip"
          v-model="partner.nip"
          autocomplete="disable"
        />
      </div>
      <p>{{ error }}</p>
      <div class="form-elem">
        <input class="submit" type="submit" value="Wyślij" />
      </div>
    </form>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";
@include form;
</style>
