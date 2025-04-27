import { createPinia } from 'pinia';
import { useSystemStore } from './modules/system.store.js';

import { useSuppliersStore } from './modules/supplier.store.js';

const pinia = createPinia();

export { useSystemStore, useSuppliersStore };
export default pinia;
