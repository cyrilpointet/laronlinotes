<template>
    <div>
        <div class="flex justify-between items-center py-2">
            <button
                :disabled="ajaxPending"
                class="btn-icon"
                @click="deleteNote"
            >
                <img :src="deleteIcon" alt="homeIcon" />
            </button>
            <button class="btn-icon" @click="back">
                <img :src="homeIcon" alt="homeIcon" />
            </button>
            <button :disabled="ajaxPending" class="btn-icon" @click="submit">
                <img :src="writeIcon" alt="writeIcon" />
            </button>
        </div>
        <div class="main-anim">
            <p class="italic">{{ note.updated }}</p>
            <textarea
                @input="setDivHeight"
                ref="textarea"
                class="w-full flex-1 mb-4 bg-white"
                v-model.trim="$v.content.$model"
                placeholder="ajoutez plusieurs lignes"
                :style="{ height: divHeight }"
            />
        </div>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import { mapState } from "vuex";
import homeIcon from "../../assets/images/home.svg";
import deleteIcon from "../../assets/images/trash.svg";
import writeIcon from "../../assets/images/poem.svg";

export default {
    name: "EditNote",
    data() {
        return {
            content: null,
            ajaxPending: false,
            divHeight: 0,
            homeIcon,
            deleteIcon,
            writeIcon,
        };
    },
    computed: {
        ...mapState({
            note: (state) => state.note,
        }),
    },
    validations: {
        content: {
            required,
        },
    },
    beforeMount() {
        this.content = this.note.content;
    },
    mounted() {
        this.setDivHeight();
    },
    methods: {
        setDivHeight() {
            const toto = this.$refs.textarea.scrollHeight;
            console.log(toto + "px");
            this.divHeight = toto + "px";
        },
        async submit() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.$store.commit("setNote", null);
                return;
            }
            this.ajaxPending = true;
            await this.$store.dispatch("saveNote", {
                noteId: this.note.id,
                content: this.content,
            });
        },
        async deleteNote() {
            if (this.note.id) {
                this.ajaxPending = true;
                await this.$store.dispatch("deleteNote", this.note.id);
            } else {
                this.$store.commit("setNote", null);
            }
        },
        back() {
            this.$store.commit("setNote", null);
        },
    },
};
</script>
