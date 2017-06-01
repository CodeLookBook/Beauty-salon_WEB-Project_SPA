
export default class ObjectTypeError extends Error {
    constructor(sType){
        let message =
            "Comments: Variable has wrong type. " +
            "It Must have " + sType + " type.";
        super(message);
    }
}
