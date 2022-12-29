<script>
import axios from "axios";
import TableFactures from "../components/TableFactures.vue";

export default {
  data() {
    return {
      factures: [],
      facture: {
        symbol: "",
        kontrahent: "",
        produkt: "",
        liczba: "",
        data: "",
        id: "",
      },
      partners: [],
      products: [],
      error: "",
      title: "Dodaj fakturę",
      editMode: false,
    };
  },
  components: { TableFactures },
  methods: {
    async fetchFactures() {
      await axios({
        method: "get",
        url: "http://localhost/sensonics/src/api/factures/api.php?action=loadfactures",
      })
        .then((res) => {
          this.factures = res.data;
        })
        .catch((err) => {
          console.log(err.message);
        });

      await axios({
        method: "get",
        url: "http://localhost/sensonics/src/api/factures/api.php?action=loadpartners",
      })
        .then((res) => {
          this.partners = res.data;
        })
        .catch((err) => {
          console.log(err.message);
        });

      await axios({
        method: "get",
        url: "http://localhost/sensonics/src/api/factures/api.php?action=loadproducts",
      })
        .then((res) => {
          this.products = res.data;
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
          url: "http://localhost/sensonics/src/api/factures/api.php?action=addfacture",
          data: this.facture,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }

      this.fetchFactures();
      this.clearForm();
    },
    async onDelete(id) {
      await axios
        .delete(
          `http://localhost/sensonics/src/api/factures/api.php?action=deletefacture&id=${id}`
        )
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err.message);
        });
      this.fetchFactures();
    },
    onEdit(data) {
      let partnerId;
      let productId;

      this.partners.filter((elem) => {
        if (elem.nazwa === data.kontrahent) {
          const id = elem.id.toString();
          partnerId = id;
        }
      });

      this.products.filter((elem) => {
        if (elem.produkt === data.produkt) {
          const id = elem.id.toString();
          productId = id;
        }
      });

      this.facture.symbol = data.symbol;
      this.facture.kontrahent = partnerId;
      this.facture.produkt = productId;
      this.facture.liczba = data.liczba.toString();
      this.facture.data = data.data;
      this.facture.id = data.id.toString();

      this.editMode = true;
      this.title = "Edytuj fakturę";
    },
    async editFacture() {
      if (this.validateForm()) {
        await axios({
          method: "post",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          url: `http://localhost/sensonics/src/api/factures/api.php?action=editfacture&id=${this.facture.id}`,
          data: this.facture,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }
      this.editMode = false;
      this.title = "Dodaj fakturę";
      this.fetchFactures();
      this.clearForm();
    },
    validateForm() {
      this.error = "";
      setTimeout(() => {
        this.error = "";
      }, 5000);

      if (
        !this.facture.kontrahent ||
        !this.facture.symbol ||
        !this.facture.produkt
      ) {
        this.error = "Nie wszystkie pola zostały uzupełnione.";
        return false;
      }

      if (this.facture.liczba < 1) {
        this.error = "Należy wskazać liczbe zamówionych sztuk.";
        return false;
      }

      if (!this.facture.data) {
        const date = new Date();

        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();

        this.facture.data = `${day}/${month}/${year}`;
      }

      return true;
    },
    clearForm() {
      this.facture.symbol = "";
      this.facture.kontrahent = "";
      this.facture.produkt = "";
      this.facture.liczba = "";
      this.facture.data = "";
    },
  },
  created() {
    this.fetchFactures();
  },
};
</script>

<template>
  <div>
    <TableFactures @delete="onDelete" @edit="onEdit" :data="factures" />
    <form
      action=""
      @submit.prevent="!this.editMode ? onSubmit() : editFacture()"
    >
      <h3>{{ title }}</h3>
      <div class="form-elem">
        <label for="symbol">Symbol:</label>
        <input
          type="text"
          name="symbol"
          v-model="facture.symbol"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="kontrahent">Kontrahent:</label>
        <select id="partner" name="kontrahent" v-model="facture.kontrahent">
          <option
            id="option"
            v-for="partner in partners"
            :key="partner.id"
            :value="partner.id"
          >
            {{ partner.nazwa }}
          </option>
        </select>
      </div>
      <div class="form-elem">
        <label for="produkt">Produkt:</label>
        <select name="produkt" v-model="facture.produkt">
          <option
            v-for="product in products"
            :key="product.id"
            :value="product.id"
            id="product"
          >
            {{ product.produkt }}
          </option>
        </select>
      </div>

      <div class="form-elem">
        <label for="liczba">Liczba:</label>
        <input
          type="number"
          name="liczba"
          v-model="facture.liczba"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="data">Wystawiono:</label>
        <input
          type="date"
          name="data"
          min="2022-01-01"
          max="2023-12-31"
          v-model="facture.data"
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
