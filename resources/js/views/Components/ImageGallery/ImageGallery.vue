<script setup>
import { ref } from 'vue';
import { watch } from 'vue';

const props = defineProps({
    existingImages: {
        type: Array,
        default: () => []
    },
    disableEdit: Boolean,
    maxImages: {
        type: Number,
        default: 6
    }
})

const emit = defineEmits(['update:images']);


watch(() => props.existingImages, (val) => {
    images.value = [...val];
});

const images = ref([]);

const removeExceedingImages = (maxImages) => {
    const excessCount = images.value.length - maxImages;
    if (excessCount > 0) {
        images.value.splice(maxImages, excessCount);
    }
};


const onFileUpdate = (e, index) => {
    const files = e.target.files || e.dataTransfer.files;
    if (!files.length) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        const newImage = {
            path: e.target.result,
            file: files[0]
        };

        images.value.splice(index, 1, newImage);
        removeExceedingImages(props.maxImages);
    };
    reader.readAsDataURL(files[0]);
};

const onFileUpload = (e) => {
    const files = e.target.files || e.dataTransfer.files;
    if (!files.length) return;

    removeExceedingImages(files.length)

    const reader = new FileReader();
    reader.onload = (e) => {
        const newImage = {
            path: e.target.result,
            name: files[0].name,
            file: files[0]
        };

        if (images.value.length < props.maxImages) {
            console.log('images.value', images.value)
            // Replace first image.value where image is undefined or path is null with new image
            images.value.push(newImage);
        }
    };
    reader.readAsDataURL(files[0]);

    // Emit the updated images array to the parent component
    emit('update:images', images.value);
};

</script>

<template>
    <div class="grid gap-4">
        <div class="relative">
            <img
                v-if="images.length && images[0].path"
                class="h-auto max-w-full rounded-lg cursor-no-drop"
                :src="images[0].path"
                :alt="images[0].alt"
            >
            <div
                v-else
                class="text-center h-80 w-full flex items-center justify-center rounded-md bg-slate-100 cursor-no-drop">
                Select Image
            </div>
        </div>
        <div class="grid grid-cols-5 gap-4 mb-4" v-if="images.length > 1">
            <template v-for="(image, index) in images" :key="index">
                <div v-if="index > 0">
                    <div class="relative" v-if="image.name === null">
                        <div class="text-center h-40 w-40 flex items-center justify-center rounded-md bg-slate-100">
                            Select
                            Image
                        </div>
                    </div>
                    <div class="relative" v-else>
                        <img class="h-auto max-w-full rounded-lg" :src="image.path" alt="">
                        <input type="file" accept="image/*"
                               :disabled="disableEdit"
                               class="absolute opacity-0 top-0 w-full h-full"
                               @change="event => onFileUpdate(event, (index))"/>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="relative mt-4" v-if="images?.length < props.maxImages">
        <input type="file" accept="image/*"
               :disabled="disableEdit"
               class="absolute opacity-0 top-0 w-full h-full z-30"
               @change="event => onFileUpload(event)"/>
        <template data-hs-file-upload-preview="">
            <div class="flex items-center w-full">
                <span class="grow-0 overflow-hidden truncate" data-hs-file-upload-file-name=""></span>
                <span class="grow-0">.</span>
                <span class="grow-0" data-hs-file-upload-file-ext=""></span>
            </div>
        </template>

        <button type="button"
                class="relative flex w-full border overflow-hidden border-gray-200 shadow-2xs rounded-lg text-sm focus:outline-hidden focus:z-10 focus:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:border-neutral-600">
            <span class="h-full py-3 px-4 bg-gray-100 text-nowrap dark:bg-neutral-800">Choose File</span>
            <span class="group grow flex overflow-hidden h-full py-3 px-4" data-hs-file-upload-previews="">
                      <span class="group-has-[div]:hidden">No Chosen File</span>
                    </span>
            <span class="absolute top-0 left-0 w-full h-full" data-hs-file-upload-trigger=""></span>
        </button>
    </div>
</template>

<style scoped>

</style>
