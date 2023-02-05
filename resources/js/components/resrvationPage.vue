<template>
    <div>
        <div>
            <reservation-details-card :details="details_card" :edit_mode="edit_mode"></reservation-details-card>

            <div class="row card card-body">

                <h4 v-if="child"> {{ translate('medical.reservation_for') }}
                    <a :href="'/admin/children/'+child.child_id" target="_blank">{{ child.name }}</a>
                    <a :href="'/admin/users/'+child.parent_id" target="_blank">{{ child.parent_name }}</a>

                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <label>{{ translate('medical.visit_type') }}</label>

                        <select v-model="reservation_type" class="form-select" name="type" id="type">
                            <option value="examanation">{{ translate('medical.examination') }}</option>
                            <option value="vaccination">{{ translate('medical.vaccination') }}</option>
                            <option value="examanation,vaccination">{{ translate('medical.examination_vaccination') }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>{{ translate('medical.visit_date') }}</label>
                        <input type="datetime-local" v-model="reservation_date" class="form-control">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>{{ translate('medical.weight') }}</label>
                        <input type="number" v-model="weight" :placeholder="translate('medical.weight')"
                               class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>{{ translate('medical.height') }}</label>
                        <input type="number" v-model="height" :placeholder="translate('medical.height')"
                               class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>{{ translate('medical.head') }}</label>
                        <input type="number" v-model="head" :placeholder="translate('medical.head')"
                               class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>{{ translate('medical.temperature') }}</label>
                        <input type="number" v-model="temp" :placeholder="translate('medical.temperature')"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <label>{{ translate('medical.doctor_comment') }} ({{ translate('medical.not_seen_by_patient') }}
                        )</label>
                    <textarea class="form-control" :placeholder="translate('medical.doctor_comment')"
                              v-model="doctor_comment">
                  </textarea>
                </div>

                <div class="col-md-12">
                    <label>{{ translate('medical.doctor_notes') }} ({{ translate('medical.seen_by_patient') }} )</label>
                    <textarea class="form-control" :placeholder="translate('medical.doctor_notes')"
                              v-model="doctor_notes">
                  </textarea>
                </div>

            </div>

            <add-medicine v-if="has_medicine" ref="medicines"></add-medicine>
            <add-medical-test v-if="has_diagnostic" ref="diagnostic" label="Diagnostic"
                              translation_key="medical.diagnostics"
                              :endpoint="'/api/diagnostic'"></add-medical-test>
            <add-medical-test v-if="has_medical_test" ref="medical_test" label="Medical Test"
                              translation_key="medical.medical_tests"
                              :endpoint="'/api/medical-test'"></add-medical-test>
            <choose-vac v-if="has_vaccination" ref="vaccination" label="vaccination"
                        :endpoint="'/api/vaccination'"></choose-vac>

            <div class="row card card-body">
                <div class="col-md-12">
                    <label>{{ translate('medical.price') }}</label>
                    <input type="number" v-model="price" :placeholder="translate('medical.price')" class="form-control">
                </div>


                <button v-if="!edit_mode" type="button" @click="save(false)"
                        class="btn btn-success waves-effect waves-light  col-md-3 m-auto display-block">
                    {{ translate('medical.save') }}
                </button>
                <div v-if="edit_mode" class="row">
                    <button type="button" @click="save(false)"
                            class=" btn btn-success waves-effect waves-light  col-md-3 m-auto display-block">
                        {{ translate('medical.edit_reservation') }}
                    </button>

                    <button type="button" @click="save(true)"
                            class="btn btn-danger waves-effect waves-light  col-md-3 m-auto display-block">
                        {{ translate('medical.end_reservation') }}
                    </button>
                </div>

            </div>
        </div>
    </div>


</template>

<script>
import axios from "axios"
import {Stretch} from 'vue-loading-spinner'

export default {
    components: {
        Stretch
    },
    mounted() {
        if (this.child_id)
            this.getDetails();
    },

    props: {
        loading: {
            default: false,
            type: Boolean
        },
        has_medicine: {
            default: true,
            type: Boolean
        },
        has_diagnostic: {
            default: true,
            type: Boolean
        },
        has_medical_test: {
            default: true,
            type: Boolean
        },
        has_vaccination: {
            default: true,
            type: Boolean
        },
        child_id: {
            default: null,
            type: Number
        },
        reservation_id: {
            default: null,
            type: Number
        },
        child: {
            default: null,
            type: Object
        },
        details_card: {
            default: null,
            type: Object
        },
        edit_mode: {
            default: false,
            type: Boolean
        }
    },
    data() {
        return {
            dropdownData: null,
            dosesDropdown: [],
            selectedData: [],
            new_add: null,
            chosenData: [],
            weight: null,
            head: null,
            temp: null,
            height: null,
            doctor_notes: null,
            doctor_comment: null,
            reservation_date: null,
            reservation_type: null,
            price: null
        }
    },
    methods: {
        getDetails: function () {
            let url = `/api/child-reservation/${this.child_id}/`
            console.log(url)
            if (this.reservation_id)
                url = url + this.reservation_id

            let self = this;
            this.loading = true;
            axios.get(url)
                .then(function (response) {
                    console.log(response.data)
                    self.fillData(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        fillData: function (data) {
            this.child = data.child
            this.details_card = data.details_card
            this.weight = data.reservation ? data.reservation.weight : null;
            this.height = data.reservation ? data.reservation.height : null;
            this.head = data.reservation ? data.reservation.head_size : null;
            this.temp = data.reservation ? data.reservation.temperature : null;
            this.reservation_type = data.reservation ? data.reservation.type : null;
            this.reservation_date = data.reservation ? data.reservation.special_datetime : null;
            this.doctor_comment = data.reservation ? data.reservation.doctor_comment : null;
            this.doctor_notes = data.reservation ? data.reservation.doctor_notes : null;
            this.price = data.reservation ? data.reservation.price : null;
            this.loading = false;

            this.$refs.diagnostic.chosenData = data.diagnostic;
            this.$refs.medical_test.chosenData = data.medical_test;
            this.$refs.vaccination.chosenData = data.vaccination;
            this.$refs.medicines.chosenData = data.medicines;
            //  this.weight = data.reservation ? data.reservation.weight: null;
        },
        save: function (edit_and_confirm = false) {
            let data = {
                weight: this.weight,
                height: this.height,
                head_size: this.head,
                temperature: this.temp,
                special_datetime: this.reservation_date,
                reservation_id: this.reservation_id,
                doctor_notes: this.doctor_notes,
                doctor_comment: this.doctor_comment,
                child_id: this.child_id,
                type: this.reservation_type,
                price: this.price,
                diagnostic: this.has_diagnostic ? this.$refs.diagnostic.chosenData : null,
                medical_test: this.has_medical_test ? this.$refs.medical_test.chosenData : null,
                vaccination: this.has_vaccination ? this.$refs.vaccination.chosenData : null,
                medicines: this.has_medicine ? this.$refs.medicines.chosenData : null,
                prespection_image: this.has_medicine ? this.$refs.medicines.image : null
            }

            const formData = new FormData();
            const headers = {'Content-Type': 'multipart/form-data'};
            Object.keys(data).forEach(key => {
                if (Array.isArray(data[key])) {
                    formData.append(key, JSON.stringify(data[key]));
                } else {
                    formData.append(key, !data[key] ? '' : data[key]);

                }
            });
            let self = this;
            axios.post('/api/store-res', formData, {headers})
                .then(function (response) {
                    console.log(edit_and_confirm)
                    if (!edit_and_confirm)
                        //console.log("edit again")
                        window.location = "/admin/edit-previous-reservation/" + self.child_id + "/" + self.reservation_id
                    else
                        //console.log("next")
                        window.location= "/admin/active-reservation"
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

#overlay {
    position: fixed; /* Sit on top of the page content */
    display: block; /* Hidden by default */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
}

label {
    margin-top: 10px
}
</style>
