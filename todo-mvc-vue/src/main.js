import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import {
  Button,
  FormModel,
  Form,
  Icon,
  Input,
  Dropdown,
  Menu,
  List,
  Checkbox,
  Row,
  Col,
  Drawer,
  Pagination,
  Table,
  Tag,
  Select,
} from "ant-design-vue";

Vue.config.productionTip = false;
Vue.use(Button);
Vue.use(FormModel);
Vue.use(Icon);
Vue.use(Input);
Vue.use(Dropdown);
Vue.use(Menu);
Vue.use(List);
Vue.use(Checkbox);
Vue.use(Row);
Vue.use(Col);
Vue.use(Drawer);
Vue.use(Pagination);
Vue.use(Table);
Vue.use(Tag);
Vue.use(Select);
Vue.use(Form);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
