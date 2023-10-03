<template>
    <div class="text-red-500" v-if="errors !== '' ">
        {{errors}}
    </div>
    <form class="space-y-6" @submit.prevent="storeCustomer">
        <div>
            <label for="name">Client Name</label>
            <input type="text" id="name" v-model="form.name">
        </div>
        <div>
            <label for="phone">Client Phone</label>
            <input type="text" id="phone" v-model="form.tel">
        </div>
        <div>
            <label for="is_favourite">is favourited ?</label>
            <input type="checkbox" id="is_favourite" v-model="form.is_favourite">
        </div>
        <div>
            <button type="submit" class="bg-white px-2 py-2 text-black rounded">Register</button>
        </div>
    </form>
</template>


<script>
import {reactive} from "vue";
import useCustomers from '../services/customerservices.js';

export default {
    setup(){
        const form = reactive({
            name: '',
            tel: '',
            is_favourite: false
        });
        
        const { createCustomer, errors } = useCustomers();

        const storeCustomer = async () => {
            await createCustomer({...form});
        };

        return{
            storeCustomer,
            form,
            errors
        }
    }
}

</script>
