<template>
    <form ref="form" @submit.prevent="submit" class="flex flex-col">
        <input
            class="my-2"
            placeholder="Email"
            v-model.trim="$v.email.$model"
        />
        <span class="error" v-if="$v.email.$dirty && !$v.email.required">
            Email requis
        </span>
        <span class="error" v-if="$v.email.$dirty && !$v.email.email">
            Email invalide
        </span>

        <input
            class="my-2"
            placeholder="Mot de passe"
            v-model.trim="$v.password.$model"
            type="password"
        />
        <span class="error" v-if="$v.password.$dirty && !$v.password.required">
            mot de passe requis
        </span>
        <button
            class="btn"
            :disabled="ajaxPending || $v.$invalid"
            type="submit"
        >
            ok
        </button>
    </form>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            ajaxPending: false,
        };
    },
    validations: {
        email: {
            required,
            email,
        },
        password: {
            required,
        },
    },
    methods: {
        submit() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                return;
            }
            this.logUser();
        },
        async logUser() {
            this.ajaxPending = true;
            try {
                await this.$store.dispatch("logUser", {
                    email: this.email,
                    password: this.password,
                });
                this.ajaxPending = false;
                const event = new CustomEvent("userLogged");
                document.dispatchEvent(event);
            } catch (error) {
                this.ajaxPending = false;
                const event = new CustomEvent("displayMsg", {
                    detail: {
                        text: "Mauvais identifiant / Mot de passe",
                        color: "error",
                    },
                });
                document.dispatchEvent(event);
            }
        },
    },
};
</script>
