export default class UndefinedReferenceError extends Error {
    constructor(){
        let message =
            "Comments: Object variable has Undefined value. " +
            "It Must be initialized.";
        super(message);
    }
}

