<script></script>

<template>
  <div>
    <h1>Wycinek systemu sprzedaży</h1>
    <h3>Aplikacja umożliwia:</h3>
    <ul>
      <li>podgląd oraz dokonywanie operacji na bazie kontrahentów</li>
      <li>podgląd oraz dokonywanie operacji na bazie towarów</li>
      <li>podgląd oraz dokonywanie operacji na bazie faktur</li>
    </ul>
  </div>
</template>

<style lang="scss" scoped>
@import "../assets/main.scss";

div {
  position: absolute;
  top: 50%;
  right: 50%;
  transform: translate(50%, -50%);
  h1 {
    color: $green;
  }
  h3 {
    padding-block: 1.4rem;
  }
  ul {
    padding-left: 1rem;
    li {
      line-height: 2rem;
    }
  }
}
</style>
