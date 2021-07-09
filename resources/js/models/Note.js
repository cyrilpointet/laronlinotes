export class Note {
    constructor(rawNote) {
        this.id = rawNote.id ? rawNote.id : null;
        this.content = rawNote.content ? rawNote.content : "";
        this.created_at = rawNote.created_at ? rawNote.created_at : null;
        this.updated_at = rawNote.updated_at ? rawNote.updated_at : null;
    }

    get created() {
        return this.created_at
            ? new Date(this.created_at).toLocaleDateString("fr-FR")
            : null;
    }

    get updated() {
        return this.updated_at
            ? new Date(this.updated_at).toLocaleDateString("fr-FR")
            : null;
    }
}
