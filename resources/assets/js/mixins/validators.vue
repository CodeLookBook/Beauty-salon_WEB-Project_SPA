<script>

    //*************************************************************************
    // CHILD COMPONENTS IMPORT
    //*************************************************************************


    //*************************************************************************
    // COMPONENT
    //*************************************************************************

    export default {

        //*********************************************************************
        // PROPERTIES
        //*********************************************************************


        //*********************************************************************
        // DATA FIELDS
        //*********************************************************************


        //*********************************************************************
        // COMPUTED FIELDS
        //*********************************************************************


        //*********************************************************************
        // WATCHED FIELDS
        //*********************************************************************


        //*********************************************************************
        // METHODS
        //*********************************************************************

        methods:{
            /**
             * @return {boolean}
             */
            IsUndefined(val){
                return typeof val === "undefined";
            },
            /**
             * @return {boolean}
             */
            IsNull(val){
                return val === null;
            },
            /**
             * @return {boolean}
             */
            IsFunction(val){
                return typeof val === 'function';
            },
            /**
             * @param val
             * @return {boolean}
             * @constructor
             */
            IsNumber(val){
                return typeof val === 'number'
            },
            /**
             * @param val
             * @return {boolean}
             * @constructor
             */
            IsSymbol(val){
                /* Символы
                 typeof Symbol() === 'symbol'
                 typeof Symbol('foo') === 'symbol'
                 typeof Symbol.iterator === 'symbol'
                 */
                return typeof val === 'symbol'
            },
            /**
             * @return {boolean}
             */
            IsString(val){
                return  typeof val === 'string' ||
                        val instanceof String;
            },
            /**
             * @return {boolean}
             */
            IsEmptyString(val){
                return val === '' && val.length === 0;
            },
            /**
             * @param val
             * @return {boolean}
             * @constructor
             */
            IsObject(val){

                let v = this;

                return  typeof val === 'object'   &&
                        val instanceof Object     &&
                        !v.IsUndefined(val)       &&
                        !v.IsNull(val)            &&
                        !v.IsFunction(val)        &&
                        !v.IsSymbol(val)          &&
                        !v.IsNumber(val)          &&
                        !(typeof val === 'string')&&
                        !(val instanceof String)  &&
                        !(val instanceof Array)   &&
                        !(val instanceof Date);
            },
        },

        //*********************************************************************
        // LIFE HOOKS
        //*********************************************************************


        //*********************************************************************
        // CHILD COMPONENTS
        //*********************************************************************


    };

</script>