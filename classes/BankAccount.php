<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
		$newBalance = $this->balance->value() + $amount->value();
		$this->balance = new Money($newBalance);	
	}

    public function transfer(Money $amount, BankAccount $account)
    {
        $this->withdraw($amount);
		$account->deposit($amount);
    }

    public function withdraw(Money $amount)
    {
		if ($amount->value() > $this->balance->value()) {
			throw new Exception('Withdrawl amount larger than balance');
		} else {
			$newBalance = $this->balance->value() - $amount->value();
			$this->balance = new Money($newBalance);
		}
    }
}