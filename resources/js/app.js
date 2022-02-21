require("./bootstrap");
import { createApp } from "vue";

import App from "./views/App.vue";
import {
  Button,
  Card
} from "./components";
import store from "./store";

const app = createApp(App);

window.app = app;

app
  .use(store)
  .component("Card", Card)
  .component("Button", Button)
  .mount("#app");
    