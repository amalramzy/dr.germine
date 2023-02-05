 <template>
    <div>
        <div class="card ribbon-box">
            <div class="card-body">
                <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> {{translate('medical.vaccinations')}} </div>

                <div class="question">
                    <p>{{translate('medical.has_vacc_question')}}</p>
                    <input type="radio" v-model="has_vacc"  :value="true" name="has_vacc">
                    <label>{{translate('medical.yes')}}</label>
                    <input type="radio"  v-model="has_vacc"   :value="false" name="has_vacc">
                    <label>{{translate('medical.no')}}</label>
                </div>
                <div class="row answer-row">
                   <div v-for="di in dropdownData" class="form-check-danger" >
                       <input type="checkbox" :disabled="!has_vacc"  class="form-check-input"  :value="di.id" v-model="chosenData"/>
                       <label class="form-check-label">{{di.name}}</label>

                   </div>
               </div>

            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios"

const default_layout = "default";
export default {
    mounted() {
        this.getData()
        if (this.chosenData.length > 0)
            this.has_vacc = true
    },
    props: {
        endpoint: {
            default:'/api/vaccination',
            type:String
        },
        has_vacc:{
            default:false,
            type: Boolean
        }
    },
    data() {
        return {
            dropdownData: null,
            chosenData: [],
        }
    },
    methods: {




        getData: function () {
            let self = this;
            axios.get(self.endpoint)
                .then(function (response) {
                    self.dropdownData = response.data
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    }

};
</script>
<style>
.question{
    margin:50px
}
.answer-row {
    margin: 20px;
}

input {
    color: black;
}

.display-block {
    display: block;
}

.center {
    text-align: center;
}

.border-black {
    border: 3px double black;
}
</style>
