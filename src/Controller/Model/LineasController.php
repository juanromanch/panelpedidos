<?php


namespace App\Controller\Model;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;
use App\Entity\Clientes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class LineasController extends BaseAdminController
{
    // Creamos el método dinámico create<NombreEntity>FormBuilder (sustituir <NombreEntity> por el nombre de la entidad o clase correspondiente)
    // para modificar el formulario de creación de pedidos filtrando el campo clientes por representantes
    public function createLinepediEntityFormBuilder($entity, $view)
    {

        // Cargamos en la variable $formBuilder la salida de la función sobreescrita
        $formBuilder = parent::createEntityFormBuilder($entity, $view);

        // Si no es superadmin (el superadmin tiene acceso total)
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {

//            // prueba 1
//            $user = $this->getUser();
//
//            $clientes = $this->getDoctrine()
//                ->getRepository(Clientes::class)
//                ->findByRepresentanteField($user);
//            $formBuilder->add(
//                'clientes', EntityType::class, [
//                'class' => Clientes::class,
//                'query_builder' => $clientes,
//                "attr" => ["class" => "form-control select2", "data-widget" => "select2"],
//                'by_reference' => false,
//                'multiple' => true,
//                'required' => false
//
//                ]
//            );
//
            // Obtenemos el id del pedido actual
            $estepedido= (int) $_GET['filters']['entity.pedido'];
            // Añadimos el campo pedido al formulario accediendo al filtro entity.pedido pasado por _GET
            // ver el createQueryBuilder: clausula where
            $formBuilder->add('pedido', EntityType::class, [
                'class' => 'App\Entity\Cabepedv',
                'query_builder' => function (EntityRepository $er) use ($estepedido) {
                    return $er->createQueryBuilder('p')
                        ->where('p = :pedido')
                        ->setParameter('pedido', $estepedido);
                },
                "attr" => ["class" => "form-control select2", "data-widget" => "select2"],
                // OJO: by:reference debe estar a true (que es el valor por defecto y por tanto se puede omitir),
                // de lo contrario intentará acceder directamente a los getter y setter de la entity padre (User): $user->getId()
                // que no está manejada por este controller y provocará un error.
                // Siendo true accedera a traves de $cabepedv->getRepresentante()->getId()
                // Ver https://symfony.com/doc/current/reference/forms/types/form.html#by-reference
                'by_reference' => true,
                'multiple' => false,
                'required' => true
            ]);

        }

        // Devolvemos el formBuilder modificado (si no es superadmin) u original (si es superadmin)

        return $formBuilder;
    }


}