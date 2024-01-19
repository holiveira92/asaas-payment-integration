<template>
    <Layout>
        <!-- Title -->
        <Head title="Lista de Pagamentos" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Lista de Pagamentos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('payments.create')">
                        <PrimaryButton>Criar Novo Pagamento</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="text-white p-4 text-left">ID</th>
                            <th class="text-white p-4 text-left">Valor</th>
                            <th class="text-white p-4 text-left">Cliente</th>
                            <th class="text-white p-4 text-left">Forma Pg.</th>
                            <th class="text-white p-4">Numero da Ordem</th>
                            <th class="text-white p-4">ID Transacao</th>
                            <th class="text-white p-4">Status</th>
                        </tr>
                        <tr v-for="payment in this.payments.data" :key="payment.id">
                            <td class="text-white px-4 py-2">{{ payment.id }}</td>
                            <td class="text-white px-4 py-2">{{ payment.amount }}</td>
                            <td class="text-white px-4 py-2">{{ payment.customer?.name }}</td>
                            <td class="text-white px-4 py-2">{{ payment.payment_method?.name }}</td>
                            <td class="text-white px-4 py-2">{{ payment.order_number }}</td>
                            <td class="text-white px-4 py-2">{{ payment.partner_transaction_id }}</td>
                            <td class="text-white px-4 py-2">{{ payment.payment_status?.name }}</td>
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
        payments: Object
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
