<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    intereses: Object,
});

const form = useForm({
    edad: props.intereses.edad || '',
    estilo_artistico: props.intereses.estilo_artistico || '',
    fandom_favorito: props.intereses.fandom_favorito || '',
    nivel_artista: props.intereses.nivel_artista || '',
    descripcion: props.intereses.descripcion || '',
});

const submit = () => {
    form.patch(route('intereses.update', props.intereses.id));
};
</script>

<template>
    <GuestLayout>
        <div class="w-full sm:max-w-2xl mt-8 px-10 py-8 bg-[#F5F5DC] border border-[#D4AF37] shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-center text-[#0B132B] mb-6">
                Editar mis intereses artísticos
            </h1>

            <form @submit.prevent="submit" class="space-y-6">

                <!-- Edad -->
                <div>
                    <InputLabel for="edad" value="Edad" />
                    <TextInput
                        id="edad"
                        type="number"
                        v-model="form.edad"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.edad" class="mt-2" />
                </div>

                <!-- Estilo artístico -->
                <div>
                    <InputLabel for="estilo_artistico" value="Estilo artístico favorito" />
                    <TextInput
                        id="estilo_artistico"
                        type="text"
                        v-model="form.estilo_artistico"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.estilo_artistico" class="mt-2" />
                </div>

                <!-- Fandom favorito -->
                <div>
                    <InputLabel for="fandom_favorito" value="Fandom favorito" />
                    <TextInput
                        id="fandom_favorito"
                        type="text"
                        v-model="form.fandom_favorito"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.fandom_favorito" class="mt-2" />
                </div>

                <!-- Nivel artista -->
                <div>
                    <InputLabel for="nivel_artista" value="Nivel de artista" />
                    <select
                        id="nivel_artista"
                        v-model="form.nivel_artista"
                        class="mt-1 block w-full bg-[#FFF8E7] border border-[#D4AF37]/50 rounded-md p-2"
                    >
                        <option value="">Selecciona</option>
                        <option value="Principiante">Principiante</option>
                        <option value="Intermedio">Intermedio</option>
                        <option value="Avanzado">Avanzado</option>
                    </select>
                    <InputError :message="form.errors.nivel_artista" class="mt-2" />
                </div>

                <!-- Descripción -->
                <div>
                    <InputLabel for="descripcion" value="Descripción personal" />
                    <textarea
                        id="descripcion"
                        v-model="form.descripcion"
                        class="mt-1 block w-full bg-[#FFF8E7] border border-[#D4AF37]/50 rounded-md p-2"
                        rows="4"
                    ></textarea>
                    <InputError :message="form.errors.descripcion" class="mt-2" />
                </div>

                <!-- Botones -->
                <div class="flex justify-between">
                    <Link
                        :href="route('profile.edit')"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition"
                    >
                        Cancelar
                    </Link>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Guardar cambios
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
