
export default class NullReferenceError extends Error {
    constructor(){
        let message =
            "Comments: Object variable has Null value. " +
            "It Must be initialized.";
        super(message);
    }
}
