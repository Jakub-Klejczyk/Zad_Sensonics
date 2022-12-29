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
  name: "TableFactures",
};
</script>

<template>
  <div class="container">
    <div v-for="facture in data" :key="facture.id" class="elem">
      <div>
        <p>{{ facture.symbol }}</p>
        <p class="name">{{ facture.kontrahent }}</p>
      </div>
      <div>
        <p>{{ facture.produkt }}</p>
        <p>{{ facture.cena }} zł</p>
      </div>
      <p>{{ facture.liczba }} szt.</p>
      <div>
        <p>RAZEM: {{ facture.cena * facture.liczba }} zł</p>
        <p>
          VAT:
          {{ Math.round(facture.cena * facture.liczba * 0.23 * 100) / 100 }} ZŁ
        </p>
      </div>
      <p>WYSTAWIONO: {{ facture.data }}</p>
      <button @click="emitData(facture)">Edytuj</button>
      <button @click="emitId(facture.id)">Usuń</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";

@include table(1400px, 1000px, 600px, 300px, 300px);
.name {
  color: rgb(73, 73, 73);
}
</style>
