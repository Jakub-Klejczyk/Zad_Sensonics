import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import PartnersView from "../views/PartnersView.vue";
import ProductsView from "../views/ProductsView.vue";
import FvView from "../views/FvView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/kontrahenci",
      name: "partners",
      component: PartnersView,
    },
    {
      path: "/towary",
      name: "products",
      component: ProductsView,
    },
    {
      path: "/faktury",
      name: "fv",
      component: FvView,
    },
  ],
});

export default router;
