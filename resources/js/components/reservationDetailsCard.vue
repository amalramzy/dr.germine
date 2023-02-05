<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row card card-body" >

                <div v-if="edit_mode" style="text-align:center">
                    <h3>{{translate('medical.edit')}}</h3>
                    <a :href="'/admin/prescription/'+details.reservation_id" target="_blank" class="btn btn-success">{{translate('medical.print_presperction')}}</a>
                    <a href="#" target="_blank" class="btn btn-success">{{translate('medical.print_medical_test')}}</a>
                    <a href="/admin/active-reservation" target="_blank" class="btn btn-danger">{{translate('medical.next')}}</a>
                </div>
                <hr>
                    <h4>{{translate('medical.reservation_details')}}</h4>

               <div class="row">
                   <div class="col-md-4">
                       <label >{{translate('medical.visit_type')}}</label>
                       <p>{{details.type}}</p>
                   </div>
                   <div class="col-md-4">
                       <label >{{translate('medical.age')}}</label>
                       <p>
                           {{details.age.d }}
                           {{translate('medical.days')}}
                           {{details.age.m }}
                           {{translate('medical.months')}}

                           {{details.age.y }}
                           {{translate('medical.years')}}

                       </p>
                   </div>
                   <div class="col-md-4">
                       <label >{{translate('medical.patient_comment')}}</label>
                       <p>{{details.patient_comment}}</p>
                   </div>
                   <div class="col-md-12">
                       <label >{{translate('medical.secretarial_comment')}}</label>
                       <p>{{details.secretarial_comment}}</p>
                   </div>
                   <div class="col-md-12">
                       <label >{{translate('medical.attached_images')}}</label>
                       <div v-for="url in details.images">
                           <img  :src='url'>
                       </div>
                   </div>
               </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    props:{
        details:{
            default:null,
            type: Object
        },
        edit_mode:{
            default:false,
            type:Boolean
        }
    }
}
</script>
