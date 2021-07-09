import { Note } from "./Note";

export class User {
    constructor(rawUser) {
        this.id = rawUser.id;
        this.name = rawUser.name;
        this.email = rawUser.email;
        this.notes = [];
        rawUser.notes.forEach((note) => {
            this.notes.push(new Note(note));
        });
    }
}
