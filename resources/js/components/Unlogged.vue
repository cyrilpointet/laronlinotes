<template>
    <div class="mx-auto container px-2 sm:px-0 py-2">
        <div class="flex justify-center max-w-screen-md mx-auto">
            <button
                class="btn flex-grow btnLeft"
                :disabled="!haveAccount"
                @click="haveAccount = false"
            >
                Je n'ai pas de compte
            </button>
            <button
                class="btn flex-grow btnRight"
                :disabled="haveAccount"
                @click="haveAccount = true"
            >
                J'ai déjà un compte
            </button>
        </div>
        <Login class="max-w-screen-sm mx-auto" v-if="haveAccount" />
        <Register class="max-w-screen-sm mx-auto" v-else />
    </div>
</template>

<script>
import Login from "./Login";
import Register from "./Register";

export default {
    name: "Unlogged",
    components: { Login, Register },
    data: () => {
        return {
            haveAccount: false,
        };
    },
};
</script>

<style lang="scss" scoped>
.btnLeft {
    border-bottom-right-radius: 0 !important;
    border-top-right-radius: 0 !important;
}
.btnRight {
    border-bottom-left-radius: 0 !important;
    border-top-left-radius: 0 !important;
}
</style>
