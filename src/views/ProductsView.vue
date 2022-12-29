<script>
import axios from "axios";
import TableProducts from "../components/TableProducts.vue";

export default {
  data() {
    return {
      products: [],
      product: {
        nazwa: "",
        cena: "",
        symbol: "",
        id: "",
      },
      error: "",
      title: "Dodaj produkt",
      editMode: false,
    };
  },
  components: { TableProducts },
  methods: {
    async fetchProducts() {
      await axios({
        method: "get",
        url: "http://localhost/sensonics/src/api/products/api.php?action=loadproducts",
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
          url: "http://localhost/sensonics/src/api/products/api.php?action=addproduct",
          data: this.product,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }

      this.fetchProducts();
      this.clearForm();
    },
    async onDelete(id) {
      await axios
        .delete(
          `http://localhost/sensonics/src/api/products/api.php?action=deleteproduct&id=${id}`
        )
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err.message);
        });
      this.fetchProducts();
    },
    onEdit(data) {
      this.product.nazwa = data.nazwa;
      this.product.cena = data.cena.toString();
      this.product.symbol = data.symbol;
      this.product.id = data.id.toString();
      this.editMode = true;
      this.title = "Edytuj produkt";
    },
    async editProduct() {
      if (this.validateForm()) {
        await axios({
          method: "post",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          url: `http://localhost/sensonics/src/api/products/api.php?action=editproduct&id=${this.product.id}`,
          data: this.product,
        })
          .then((res) => {
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err.message);
          });
      }
      this.editMode = false;
      this.title = "Dodaj produkt";
      this.fetchProducts();
      this.clearForm();
    },
    validateForm() {
      this.error = "";

      setTimeout(() => {
        this.error = "";
      }, 5000);

      if (!this.product.nazwa || !this.product.cena || !this.product.symbol) {
        this.error = "Nie wszystkie pola zostały uzupełnione.";
        return false;
      }

      if (!this.product.cena.match(/^\d{0,8}(\.\d{1,4})?$/)) {
        this.error = "Niepoprawna cena produktu.";
        return false;
      }

      return true;
    },
    clearForm() {
      this.product.nazwa = "";
      this.product.cena = "";
      this.product.symbol = "";
    },
  },
  created() {
    this.fetchProducts();
  },
};
</script>

<template>
  <div>
    <TableProducts @delete="onDelete" @edit="onEdit" :data="products" />
    <form
      action=""
      @submit.prevent="!this.editMode ? onSubmit() : editProduct()"
    >
      <h3>{{ title }}</h3>
      <div class="form-elem">
        <label for="nazwa">Nazwa:</label>
        <input
          type="text"
          name="nazwa"
          v-model="product.nazwa"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="cena">Cena:</label>
        <input
          type="text"
          name="cena"
          v-model="product.cena"
          autocomplete="disable"
        />
      </div>
      <div class="form-elem">
        <label for="symbol">Symbol:</label>
        <input
          type="text"
          name="symbol"
          v-model="product.symbol"
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
