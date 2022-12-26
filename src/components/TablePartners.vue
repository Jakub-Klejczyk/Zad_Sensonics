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
  name: "TablePartners",
};
</script>

<template>
  <div class="container">
    <div v-for="partner in data" :key="partner.id" class="elem">
      <p class="name">{{ partner.nazwa }}</p>
      <p>{{ partner.adres }}</p>
      <p>tel.: {{ partner.telefon }}</p>
      <p>{{ partner.mail }}</p>
      <p>NIP: {{ partner.nip }}</p>
      <button @click="emitData(partner)">Edytuj</button>
      <button @click="emitId(partner.id)">Usuń</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";

@include table(1400px, 1000px, 600px, 350px, 160px);
</style>
