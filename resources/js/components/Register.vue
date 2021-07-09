<template>
    <form ref="form" @submit.prevent="submit" class="flex flex-col">
        <input class="my-2" v-model.trim="$v.name.$model" placeholder="Nom" />
        <span class="error" v-if="$v.name.$dirty && !$v.name.required">
            nom requis
        </span>

        <input
            class="my-2"
            v-model.trim="$v.email.$model"
            placeholder="Email"
        />
        <span class="error" v-if="$v.email.$dirty && !$v.email.required">
            Email requis
        </span>
        <span class="error" v-if="$v.email.$dirty && !$v.email.email">
            Email invalide
        </span>

        <input
            class="my-2"
            v-model.trim="$v.password.$model"
            type="password"
            placeholder="Mot de passe"
        />
        <span class="error" v-if="$v.password.$dirty && !$v.password.required">
            Mot de passe requis
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
            name: "",
            email: "",
            password: "",
            ajaxPending: false,
        };
    },
    validations: {
        name: {
            required,
        },
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
            this.register();
        },
        async register() {
            this.ajaxPending = true;
            try {
                await this.$store.dispatch("createUser", {
                    name: this.name,
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
                        text: "Cet email est déjà utilisé",
                        color: "error",
                    },
                });
                document.dispatchEvent(event);
            }
        },
    },
};
</script>
