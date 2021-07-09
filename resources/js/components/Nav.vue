<template>
    <div class="bg-primary text-white shadow">
        <div class="container mx-auto py-2 text-center md:text-left">
            <h1 v-if="isLogged" class="text-2xl">{{ user.name }}'s notes</h1>
            <h1 v-else class="text-2xl">Hello</h1>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";

export default {
    name: "Nav",
    computed: {
        ...mapGetters({
            isLogged: "isLogged",
        }),
        ...mapState({
            user: (state) => state.user,
        }),
    },
};
</script>
