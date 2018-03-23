<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\OptionsResolver\OptionsResolver;

	class ProfileType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder
				->add('firstname', TextType::class, array(
					'label' => 'Prénom'
				))
				->add('lastname', TextType::class, array(
					'label' => 'Nom'
				))
				->add('phone', TelType::class, array(
					'label' => 'Numéro de téléphone'
				))
			;
		}

		public function getParent()
	    {
	        return 'FOS\UserBundle\Form\Type\ProfileFormType';
	    }

	    public function getBlockPrefix()
	    {
	        return 'app_user_profile';
	    }
	}