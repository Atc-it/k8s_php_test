# k8s_php_test
An example of how you can use kubernetes (k8s) as your orchestration tool. In this example Symfony2 will be used
as the development framework. This same example should work on any k8s installation but it was tested and will 
be described as a local environment installation.

1 - Install Docker

* Linux/Ubuntu

Follow the instructions on [docker official page](https://docs.docker.com/installation/ubuntulinux/)

* Windows

Follow the instructions on [docker tool box official page](https://www.docker.com/toolbox)

2 - Setup k8s local cluster

Follow the instructions on [k8s official page](http://kubernetes.io/v1.0/docs/getting-started-guides/docker.html)

3 - Get the code

    git clone git@github.com:bitgandtter/k8s_php_test.git
    
4 - Move to the directory

    cd k8s_php_test
  
4 - Build the image

    cd development_tools/cluster_config/app && bash build-image.sh && cd ../../../
    
5 - Create the environment

    cd development_tools/cluster_config && bash recreate.sh && cd ../../
    
6 - Get the ip of the service

    cd development_tools/cluster_config && bash get_pods_and_services.sh && cd ../../

7 - Browse the app on the ip from the previous step
    
8 - Test scale the app up

    cd development_tools/cluster_config/app && bash scale-up.sh && cd ../../../
    
9 - Test rolling update

* Make some changes on the code, example change the displaying image from image.png to image2.png on the display template

before: framework/app/Resources/views/default/display.twig.html

    {% image '@AppBundle/Resources/public/images/image.png' %}
    
after: framework/app/Resources/views/default/display.twig.html

    {% image '@AppBundle/Resources/public/images/image2.png' %}
    
* Build a new image the same command on step #4

        cd development_tools/cluster_config/app && bash build-image.sh && cd ../../../
    
* Roll the update

        cd development_tools/cluster_config && bash rolling_release.sh && cd ../../
        
10 - Test scale down

    cd development_tools/cluster_config/app && bash scale-down.sh && cd ../../../
    
11 - Destroy the environment

    cd development_tools/cluster_config/app && bash delete.sh && cd ../../../
    
