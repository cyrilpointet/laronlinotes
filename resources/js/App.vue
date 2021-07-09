<template>
    <div>
        <Nav />
        <Main v-if="isLogged" />
        <Unlogged v-else />
    </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import Unlogged from "./components/Unlogged";
import Main from "./components/Main";
import Nav from "./components/Nav";

export default {
    name: "App",
    components: { Unlogged, Main, Nav },
    computed: {
        ...mapGetters({
            isLogged: "isLogged",
        }),
        ...mapState({
            user: (state) => state.user,
            note: (state) => state.note,
        }),
    },
};
</script>
