<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <div>
    <nav>
      <RouterLink class="link" to="/">Strona główna</RouterLink>
      <RouterLink class="link" to="/kontrahenci">Kontrahenci</RouterLink>
      <RouterLink class="link" to="/towary">Towary</RouterLink>
      <RouterLink class="link" to="/faktury">Faktury</RouterLink>
    </nav>
    <RouterView />
  </div>
</template>

<style lang="scss" scoped>
@import "./assets/main.scss";

nav {
  width: 100vw;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  flex-wrap: wrap;
  background-color: $green;
  .link {
    color: $white;
    text-decoration: none;
    font-size: 1.4rem;
  }
}
</style>
