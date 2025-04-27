import { defineStore } from 'pinia'
import axios from 'axios'

export const useSuppliersStore = defineStore('suppliers', {
    state: () => ({
        suppliers: [],
        loading: false,
        error: null,
    }),
    actions: {
        async fetchSuppliers() {
            this.loading = true
            try {
                const { data } = await axios.get('/api/suppliers')
                this.suppliers = data
                this.error = null
            } catch (e) {
                this.error = e
            } finally {
                this.loading = false
            }
        },
        async addSupplier(supplier) {
            try {
                const { data } = await axios.post('/api/suppliers', supplier)
                this.suppliers.push(data)
                this.error = null
                return data
            } catch (e) {
                this.error = e
                throw e
            }
        },
        async updateSupplier(id, supplier) {
            try {
                const { data } = await axios.put(`/api/suppliers/${id}`, supplier)
                const idx = this.suppliers.findIndex(s => s.id === id)
                if (idx !== -1) this.suppliers[idx] = data
                this.error = null
                return data
            } catch (e) {
                this.error = e
                throw e
            }
        },
        async deleteSupplier(id) {
            try {
                await axios.delete(`/api/suppliers/${id}`)
                this.suppliers = this.suppliers.filter(s => s.id !== id)
                this.error = null
            } catch (e) {
                this.error = e
                throw e
            }
        },
        getSupplierById(id) {
            return this.suppliers.find(s => s.id === id)
        },
    },
})
