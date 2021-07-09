<template>
    <div class="container mx-auto px-2 md:px-0">
        <transition name="fade" mode="out-in">
            <div v-if="!note">
                <div class="flex justify-between items-center py-2">
                    <button class="btn-icon" @click="logout">
                        <img :src="logoutIcon" alt="logoutIcon" />
                    </button>
                    <button class="btn-icon" @click="addNote">
                        <img :src="addNoteIcon" alt="homeIcon" />
                    </button>
                </div>
                <div
                    class="
                        grid
                        gap-4
                        grid-cols-2
                        md:grid-cols-4
                        lg:grid-cols-6
                        pt-4
                        main-anim
                    "
                >
                    <div
                        class="note"
                        v-for="(listNote, index) in user.notes"
                        :key="index"
                        @click="editNote(listNote)"
                    >
                        <pre class="content">
                    {{ listNote.content }}
                </pre
                        >
                    </div>
                </div>
            </div>
            <EditNote v-else />
        </transition>
    </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import EditNote from "./EditNote";
import logoutIcon from "../../assets/images/unicorn_sleep.svg";
import addNoteIcon from "../../assets/images/unicorn_add.svg";
import { Note } from "../models/Note";

export default {
    name: "Main",
    components: { EditNote },
    data: () => {
        return { logoutIcon, addNoteIcon };
    },
    computed: {
        ...mapGetters({
            isLogged: "isLogged",
        }),
        ...mapState({
            user: (state) => state.user,
            note: (state) => state.note,
        }),
    },
    methods: {
        logout() {
            this.$store.dispatch("logout");
        },
        addNote() {
            this.$store.commit("setNote", new Note({ content: "" }));
        },
        editNote(note) {
            this.$store.commit("setNote", note);
        },
    },
};
</script>

<style lang="scss" scoped>
.note {
    @apply relative bg-white border-solid border-8 border-primary rounded-xl w-full h-0 cursor-pointer shadow;
    padding-top: 100%;
    transition: 0.1s linear all;
    &:hover {
        @apply bg-secondary shadow-lg;
        transform: rotate(2deg) scale(1.1);
    }
}
.content {
    @apply absolute inset-0 overflow-hidden p-4;
    white-space: pre-line;
}
</style>
