<template>
    <div>
        <div class="card ribbon-box">
            <div class="card-body">
                <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> {{translate('medical.medicines')}}</div>
                <div class="row answer-row">
                    <button class="btn btn-info rounded-pill waves-effect  col-md-3 m-auto display-block" v-on:click="addExistData()">{{translate('medical.add')}}
                    </button>
                    <button  class="btn btn-success rounded-pill waves-effect col-md-3 m-auto display-block"
                            v-on:click="addNewData()"> {{translate('medical.add_new')}}
                    </button>

                </div>


                <div class="form-group " v-for="(d,index) in this.chosenData" :key="index">


                    <div class=" row answer-row">
                        <div class="col-md-3" v-if="d.type === 'exist'">
                            <label>{{translate('medical.medicine')}}</label>

                            <ejs-dropdownlist id='dropdownlist' placeholder='Select '
                                              :dataSource='dropdownData' :fields='fields'
                                              v-model="d.selectedMed"
                                              :allowFiltering='true' ></ejs-dropdownlist>

<!--                            <select :name="`chosenData[${index}][selectedMed]`" id="input-event_id"-->
<!--                                    class="form-control "-->
<!--                                    v-model="d.selectedMed" required>-->
<!--                                <option disabled selected value="0"> Please select</option>-->
<!--                                <option v-for="di in dropdownData" :value="`${di.id}`">{{ di.name }}</option>-->
<!--                            </select>-->
                        </div>

                        <div class="col-md-3" v-if="d.type === 'new'">
                            <label>{{translate('medical.medicine')}}</label>

                            <input type="text" placeholder="Enter Data ?" class="form-control"
                                   v-model="d.val"
                                   :name="`chosenData[${index}][val]`">
                        </div>

                        <div class="col-md-3">
                            <label>{{translate('medical.alt_medicine')}}</label>
                            <ejs-dropdownlist id='dropdownlist' placeholder='Select '
                                              :dataSource='dropdownData' :fields='fields'
                                              v-model="d.selectedAltMed"
                                              :allowFiltering='true' ></ejs-dropdownlist>
<!--                            <select :name="`chosenData[${index}][selectedAltMed]`" id="input-event_id"-->
<!--                                    class="form-control "-->
<!--                                    v-model="d.selectedAltMed" required>-->
<!--                                <option disabled selected value="0"> Please select</option>-->
<!--                                <option v-for="di in dropdownData" :value="`${di.id}`">{{ di.name }}</option>-->
<!--                            </select>-->
                        </div>
                        <div class="col-md-3">
                            <label>{{translate('medical.dose')}}</label>
                            <ejs-dropdownlist id='dropdownlist' placeholder='Select '
                                              :dataSource='dosesDropdown' :fields='fields'
                                              v-model="d.selectedDose"
                                              :allowFiltering='true' ></ejs-dropdownlist>
<!--                            <select :name="`chosenData[${index}][selectedDose]`" id="input-event_id"-->
<!--                                    class="form-control "-->
<!--                                    v-model="d.selectedDose" required>-->
<!--                                <option disabled selected value="0"> Please select</option>-->
<!--                                <option v-for="di in dosesDropdown" :value="`${di.id}`">{{ di.name }}</option>-->
<!--                            </select>-->
                        </div>

                        <div class="col-md-2">
                            <label>{{translate('medical.period')}}</label>

                            <input type="number" placeholder="Enter Data ?" class="form-control"
                                   v-model="d.period"
                                   :name="`chosenData[${index}][period]`">

                        </div>

                        <div class="col-md-1" style="margin-top:21px">
                            <button class="btn btn-danger" v-on:click="removeData(index)">-</button>

                        </div>


                        <div class="col-md-12">
                            <label>{{translate('medical.notes')}}</label>

                            <textarea :name="`chosenData[${index}][notes]`" placeholder="notes" v-model="d.notes"
                                      class="form-control"></textarea>
                        </div>

                    </div>

                    <!--        <div style="text-align: center">-->
                    <!--            <button class="btn btn-primary" v-on:click="savePoll()">Save Poll</button>-->
                    <!--        </div>-->
                </div>

               <label>{{translate('medical.prespection_image')}}</label>
                <input type="file" @change="uploadFile" ref="file">


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
        this.getDoses()
    },
    props: {
        label: {
            default:'Medicine',
            type:String
        },
        endpoint:{
            default: '/api/medicines',
            type:String

        },
        image:{
            default:null
        }
    },
    data() {
        return {
            dropdownData: null,
            dosesDropdown: [],
            selectedData: [],
            new_add: null,
            chosenData: [],
            fields: { text: 'name', value: 'id' },

        }
    },
    methods: {
        uploadFile() {
            this.image = this.$refs.file.files[0];
        },
        addExistData: function () {
            this.chosenData.push({
                type: "exist",
                selectedMed: null,
                selectedAltMed: null,
                selectedDose: null,
                period: null,
                notes: null
            })

        },
        addNewData: function () {
            this.chosenData.push({
                type: "new",
                val: null,
                selectedAltMed: null,
                selectedDose: null,
                period: null,
                notes: null


            })
            console.log(this.chosenData)
        },
        removeData: function (index) {
            this.$delete(this.chosenData, index)


        },
        getData: function () {
            let self = this;
            axios.get('/api/medicines')
                .then(function (response) {
                    self.dropdownData = response.data
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getDoses: function () {
            let self = this;
            console.log(self.dosesDropdown)
            axios.get('/api/doses')
                .then(function (response) {
                    self.dosesDropdown = response.data
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
