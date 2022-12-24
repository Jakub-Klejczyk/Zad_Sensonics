<script>
import axios from "axios";
import Table from "../components/Table.vue";

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
      },
    };
  },
  components: { Table },
  methods: {
    async fetchPartners() {
      await axios({
        method: "get",
        url: "http://localhost/zad/sensonics/src/api/api.php?action=loaddata",
      })
        .then((res) => {
          this.partners = res.data;
        })
        .catch((err) => {
          console.log(err.message);
        });
    },
    onSubmit() {
      if (this.validateForm()) {
        axios({
          method: "post",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          url: "http://localhost/zad/sensonics/src/api/api.php?action=addpartner",
          data: this.partner,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }
      console.log(this.partner);
      this.fetchPartners();
      this.clearForm();
    },
    validateForm() {
      return false;
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
    <Table :data="partners" />
    <form action="" @submit.prevent="onSubmit">
      <h3>Dodaj kontrahenta</h3>
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
      <div class="form-elem">
        <input type="submit" value="Dodaj kontrahenta" />
      </div>
    </form>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";

form {
  margin: 0 auto;
  width: 400px;
  background-color: red;
}
</style>
