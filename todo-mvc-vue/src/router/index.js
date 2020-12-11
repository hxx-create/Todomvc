import Vue from "vue";
import VueRouter from "vue-router";

import Login from "../view/Login";
import Todo from "../view/Todo";
import Register from "../view/Register";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/todo",
    name: "todo",
    component: Todo,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
];

const router = new VueRouter({
  mode: "history",
  //   base: process.env.BASE_URL,
  routes,
});

export default router;
