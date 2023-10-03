<template>
    
<div class="relative overflow-x-auto">
    <div class="py-5">
        <router-link :to="{name: 'customers.create'}" class="bg-green-500 px-2 py-2 text-white rounded">
            New Client
        </router-link>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Favourited
                </th>
                <th scope="col" class="px-6 py-3">
                    Modify ?
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete ?
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="customer in customers" :key="customer.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{customer.name}}
                </th>
                <td class="px-6 py-4" >
                    {{customer.tel}}
                </td>
                <td class="px-6 py-4">
                    <span :class="{'text-green-400' : customer.is_favourite}">{{customer.is_favourite}}</span>
                </td>
                <td class="px-6 py-4">
                    <router-link class="text-yellow-500" :to="{ name:'customers.edit', params:{id: customer.id} }" >Modify</router-link>
                </td>
                <td class="px-6 py-4">
                    <button @click="deleteCustomer(customer.id)" class="text-red-500">delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</template>


<script>
import useCustomers from "../services/customerservices";
import {onMounted} from "vue";
export default {
    setup(){
        const {customers, getCustomers, destroyCustomer } = useCustomers();
        onMounted(getCustomers());

        const deleteCustomer = async (id) => {
            await destroyCustomer(id);
        };

        return{
            customers,
            deleteCustomer
        };
    }
}

</script>
