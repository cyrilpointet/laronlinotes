import Vue from "vue";
import Vuelidate from "vuelidate";

import App from "./App";
import { store } from "./store/store";
import { ApiConsumer } from "./services/ApiConsumer";

Vue.use(Vuelidate);

new Vue({
    store,
    el: "#app",
    components: { App },
    async beforeCreate() {
        const token = localStorage.getItem("token");
        if (token) {
            ApiConsumer.setToken(token);
            try {
                await this.$store.dispatch("getUserWithToken");
                await this.$store.commit("setToken", token);
            } catch (e) {
                console.log(e);
                this.$store.dispatch("logout");
            }
        } else {
            this.$store.dispatch("logout");
        }
    },
});
