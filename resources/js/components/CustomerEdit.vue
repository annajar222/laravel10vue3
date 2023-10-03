<template>
    <div class="text-red-500" v-if="errors !== '' ">
        {{errors}}
    </div>
    <form class="space-y-6" @submit.prevent="saveCustomer">
        <div>
            <label for="name">Client Name</label>
            <input type="text" id="name" v-model="customer.name">
        </div>
        <div>
            <label for="phone">Client Phone</label>
            <input type="text" id="phone" v-model="customer.tel">
        </div>
        <div>
            <label for="is_favourite">is favourited ?</label>
            <input type="checkbox" id="is_favourite" v-model="customer.is_favourite">
        </div>
        <div>
            <button type="submit" class="bg-white px-2 py-2 text-black rounded">Modify</button>
        </div>
    </form>
</template>


<script>
import {onMounted, reactive} from "vue";
import useCustomers from '../services/customerservices.js';

export default {
    props: {
        id:{
            required: true,
            type: String
        }
    },
    setup(props){

        const { getCustomer, customer, updateCustomer, errors } = useCustomers();

        onMounted(getCustomer(props.id));

        const saveCustomer = async () => {
            await updateCustomer(props.id);
        };

        return{
            saveCustomer,
            customer,
            errors
        }
    }
}

</script>
