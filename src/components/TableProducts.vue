<script>
export default {
  props: {
    data: Array,
  },
  data() {
    return {};
  },
  methods: {
    emitId(id) {
      this.$emit("delete", id);
    },
    emitData(data) {
      this.$emit("edit", data);
    },
  },
  name: "TableProducts",
};
</script>

<template>
  <div class="container">
    <div v-for="product in data" :key="product.id" class="elem">
      <p class="name">{{ product.nazwa }}</p>
      <p>{{ product.cena }} zł</p>
      <p>Symbol: {{ product.symbol }}</p>
      <button @click="emitData(product)">Edytuj</button>
      <button @click="emitId(product.id)">Usuń</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";

@include table(1400px, 1000px, 600px, 350px, 120px);
</style>
