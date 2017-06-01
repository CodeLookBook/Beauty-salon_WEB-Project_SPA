
export default class SrcError extends Error {
    constructor(){
        let message =
            "Comments: Wrong value of image src attribute. " +
            "It's undefined, null, empty or has wrong type. " +
            "Pleas initialize it by valid value.";
        super(message);
    }
}
