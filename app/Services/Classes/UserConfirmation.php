<?php


namespace App\Services\Classes;

use Carbon\Carbon;

/**
 * UserConfirmation trait
 * to validate and confirm user activation
 * you can you in any User class
 * this trait required two field should be in User table
 * [confirmation_code, updated_at]
 * */
trait UserConfirmation
{
    protected $valid_confirmation;

    protected $code_time_expire = 60;

    protected $today;
    //   protected $confirmation_code;

    /**
     * check_confirmation_code
     * to check the expired time for the confirmation code
     * @return bool valid_confirmation
     */
    public function check_confirmation_code()
    {
        $today = Carbon::now();
        if ($today->diffInDays($this->code_verified_at) || $today->diffInMinutes($this->code_verified_at) >= $this->code_time_expire) {
            return $this->valid_confirmation = false;
        }
        $this->status = 'active';

        $this->confirmation_code = null;
        $this->save();
        return $this->valid_confirmation = true;
    }

    public static function get_confirmation_code($confirmation_code)
    {
        $user = static::where('confirmation_code', $confirmation_code)->get();
        if (!$user) {
            return false;
        }
        return $user->check_confirmation_code();
    }

    /**
     * Generate User confirmation code and save it
     * @return $this
     * */
    protected function generate_confirm_code()
    {
        if ($this->is_expired_code()) {
            $this->confirmation_code = rand(9999, 1000);
            $is_confirmation_code = static::where('confirmation_code', $this->confirmation_code)->count();
            $this->code_verified_at = $this->today;
            if ($is_confirmation_code) {
                return $this->generate_confirm_code();
            }

            $this->save();
        }
        return $this;
    }

    public function send_reset_code()
    {
        $this->generate_confirm_code()->sendPasswordResetNotification($this->confirmation_code);
    }

    public function is_expired_code()
    {
        $this->today = Carbon::now();

        if (!is_null($this->confirmation_code)  && ($this->today->diffInDays($this->code_verified_at) || $this->today->diffInMinutes($this->code_verified_at) <= $this->code_time_expire)) {
            return false;
        }
        return true;
    }
}
