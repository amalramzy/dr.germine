
<template>

    <div class="card ribbon-box">
        <div class="card-body">
            <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> {{translate(this.translation_key)}}</div>

        </div>
        <div class="row answer-row">
            <button class="btn btn-info rounded-pill waves-effect  col-md-3 m-auto display-block" v-on:click="addExistData()">{{translate('medical.add')}}
            </button>
            <button  class="btn btn-success rounded-pill waves-effect col-md-3 m-auto display-block" v-on:click="addNewData()">{{translate('medical.add_new')}}
            </button>

        </div>

        <div class="form-group " v-for="(d,index) in this.chosenData" :key="index">


            <div class=" row answer-row" v-if="d.type === 'exist'">
                <div class="col-md-10">
                    <ejs-dropdownlist id='dropdownlist' placeholder='Select'
                                      :dataSource='dropdownData' :fields='fields'
                                      v-model="d.selected"
                                      :allowFiltering='true' ></ejs-dropdownlist>

<!--                    <select :name="`chosenData[${index}][selected]`" id="input-event_id" class="form-control "-->
<!--                            v-model="d.selected" required>-->
<!--                        <option disabled selected  value="0"> Please select</option>-->
<!--                        <option v-for="di in dropdownData" :value="`${di.id}`">{{ di.name }}</option>-->
<!--                    </select>-->
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger" v-on:click="removeData(index)">-</button>

                </div>

            </div>

            <div class="row answer-row" v-else-if="d.type === 'new'">
                <div class="col-md-10">
                    <input type="text" placeholder="Enter Data ?" class="form-control" v-model="d.val"
                           :name="`chosenData[${index}][val]`">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger" v-on:click="removeData(index)">-</button>

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
    },
    props: {
        label: {
            default:'Data',
            type:String
        },
        translation_key: {
            default:'data',
            type:String
        },
        endpoint: {
            default:'/api/dig',
            type:String
        },
        selectedQuestions: null,
        pollId:null
    },
    data() {
        return {
            dropdownData:null,
            selectedData:[],
            new_add:null,
            chosenData:[],
            fields: { text: 'name', value: 'id' },

        }
    },
    methods: {

        addExistData: function () {
            this.chosenData.push({
                type: "exist",
                selected:null
            })
        },
        addNewData: function () {
            this.chosenData.push({
                type: "new",
                val:null
            })

        },
        removeData:function (index){
            this.$delete(this.chosenData, index)

        },
        getData: function () {
            let self = this;
            axios.get(self.endpoint)
                .then(function (response) {
                    self.dropdownData = response.data
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
};
</script>
<style>
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
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";
</style>
