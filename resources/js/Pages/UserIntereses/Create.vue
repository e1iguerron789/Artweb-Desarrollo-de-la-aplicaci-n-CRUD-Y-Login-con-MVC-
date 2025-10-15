<script setup>
import { useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    edad: '',
    estilo_artistico: '',
    fandom_favorito: '',
    nivel_artista: '',
    descripcion: '',
});

const submit = () => {
    form.post(route('intereses.store'));
};
</script>

<template>
    <GuestLayout>
        <div class="w-full sm:max-w-2xl mt-8 px-10 py-8 bg-[#F5F5DC] border border-[#D4AF37] shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-center text-[#0B132B] mb-6">
                Cuéntanos sobre tus intereses artísticos
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
                        placeholder="Ej: 22"
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
                        placeholder="Ej: Realismo, Anime, Surrealismo"
                    />
                    <InputError :message="form.errors.estilo_artistico" class="mt-2" />
                </div>

                <!-- Fandom -->
                <div>
                    <InputLabel for="fandom_favorito" value="Fandom favorito" />
                    <TextInput
                        id="fandom_favorito"
                        type="text"
                        v-model="form.fandom_favorito"
                        class="mt-1 block w-full"
                        placeholder="Ej: Marvel, Studio Ghibli"
                    />
                    <InputError :message="form.errors.fandom_favorito" class="mt-2" />
                </div>

                <!-- Nivel artista -->
                <div>
                    <InputLabel for="nivel_artista" value="Nivel como artista" />
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
                        placeholder="Cuéntanos más sobre ti, tu arte, tu estilo..."
                    ></textarea>
                    <InputError :message="form.errors.descripcion" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="text-center">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Guardar intereses
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
