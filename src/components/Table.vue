<script>
export default {
  props: {
    data: Array,
  },
  data() {
    return {};
  },
  name: "Table",
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
      <button>Edytuj</button>
      <button>Usuń</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";
.container {
  margin: 2rem auto;
  width: 1400px;

  .elem {
    padding-inline: 1rem;
    border: 2px solid $green;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 60px;
    margin-bottom: 1rem;
    button {
      @include btn;
    }
  }
}
</style>
