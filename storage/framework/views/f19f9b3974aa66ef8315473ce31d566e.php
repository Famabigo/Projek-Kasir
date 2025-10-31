<section>
    <p class="text-sm text-gray-600 mb-6">
        Perbarui informasi profil dan alamat email Anda.
    </p>

    <form method="post" action="<?php echo e(route('profile.update')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        <div>
            <label for="name" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                value="<?php echo e(old('name', $user->name)); ?>" 
                required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                style="border-color: #B1D7F2;">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold mb-2" style="color: #0C5587;">Email</label>
            <input id="email" name="email" type="email" 
                value="<?php echo e(old('email', $user->email)); ?>" 
                required autocomplete="username"
                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                style="border-color: #B1D7F2;">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        <?php echo e(__('Your email address is unverified.')); ?>


                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <?php echo e(__('Click here to re-send the verification email.')); ?>

                        </button>
                    </p>

                    <?php if(session('status') === 'verification-link-sent'): ?>
                        <p class="mt-2 font-medium text-sm text-green-600">
                            <?php echo e(__('A new verification link has been sent to your email address.')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-3 rounded-lg text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
<?php /**PATH C:\laragon\www\kasir\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>