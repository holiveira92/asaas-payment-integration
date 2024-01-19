<template>
    <Layout>
        <!-- Title -->
        <Head title="Lista de Clientes" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Lista de Clientes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="text-white p-4 text-left">Nome</th>
                            <th class="text-white p-4 text-left">Email</th>
                            <th class="text-white p-4 text-left">Documento</th>
                            <th class="text-white p-4 text-left">Telefone</th>
                            <th class="text-white p-4 text-left">ID Externo</th>
                        </tr>
                        <tr v-for="customer in this.customers.data" :key="customer.id">
                            <td class="text-white px-4 py-2">{{ customer.name }}</td>
                            <td class="text-white px-4 py-2">{{ customer.email }}</td>
                            <td class="text-white px-4 py-2">{{ customer.document }}</td>
                            <td class="text-white px-4 py-2">{{ customer.phone }}</td>
                            <td class="text-white px-4 py-2">{{ customer.external_id }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Layout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        customers: Array
    },
    data() {
        return {
            form: useForm({
            })
        };
    },
    mounted() {
    },
    methods: {
    },
};
</script>
