import Vue from "vue";
import Vuex from "vuex";
import { ApiConsumer } from "../services/ApiConsumer";
import { User } from "../models/User";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: null,
        token: null,
        note: null,
    },
    getters: {
        isLogged: (state) => {
            return state.user !== null && state.token !== null;
        },
    },
    mutations: {
        setUser(state, value) {
            state.user = value;
        },
        setToken(state, value) {
            state.token = value;
        },
        setNote(state, value) {
            state.note = value;
        },
    },
    actions: {
        storeUserAndToken(context, value) {
            const user = new User(value.user);
            context.commit("setUser", user);
            context.commit("setToken", value.token);
            ApiConsumer.setToken(value.token);
            localStorage.setItem("token", value.token);
        },

        createUser(context, values) {
            return ApiConsumer.post("register", values).then((data) => {
                context.dispatch("storeUserAndToken", data);
            });
        },

        logUser(context, values) {
            return ApiConsumer.post("login", values).then((data) => {
                context.dispatch("storeUserAndToken", data);
            });
        },

        getUserWithToken(context) {
            return ApiConsumer.get("user").then((data) => {
                const user = new User(data);
                context.commit("setUser", user);
            });
        },

        logout(context) {
            context.commit("setUser", null);
            context.commit("setToken", null);
            ApiConsumer.removeToken();
            localStorage.removeItem("token");
        },

        saveNote(context, values) {
            if (values.noteId) {
                return ApiConsumer.put("note/" + values.noteId, {
                    text: values.content,
                }).then((data) => {
                    const user = new User(data);
                    context.commit("setUser", user);
                    context.commit("setNote", null);
                });
            } else {
                return ApiConsumer.post("note", {
                    text: values.content,
                }).then((data) => {
                    const user = new User(data);
                    context.commit("setUser", user);
                    context.commit("setNote", null);
                });
            }
        },

        deleteNote(context, noteId) {
            return ApiConsumer.delete("note/" + noteId).then((data) => {
                const user = new User(data);
                context.commit("setUser", user);
                context.commit("setNote", null);
            });
        },
    },
});

export { store };
