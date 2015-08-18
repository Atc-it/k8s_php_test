# k8s_php_test
An example of how you can use kubernetes (k8s) as your orchestration tool. In this example Symfony2 will be used
as the development framework. This same example should work on any k8s installation but it was tested and will 
be described as a local environment installation.

1 - Install Docker

* Linux/Ubuntu

Follow the instructions on [docker official page](https://docs.docker.com/installation/ubuntulinux/).

* Windows

Follow the instructions on [docker tool box official page](https://www.docker.com/toolbox).

2 - Setup k8s local cluster

Follow the instructions on [k8s official page](http://kubernetes.io/v1.0/docs/getting-started-guides/docker.html). 
Also ensure you have in your $PATH the kubectl binary.

3 - Get the code

    git clone git@github.com:bitgandtter/k8s_php_test.git
    
4 - Move to the directory

    cd k8s_php_test
  
5 - Build the image

    bash development_tools/cluster_config/app/build-image.sh
    
6 - Create the environment

    bash development_tools/cluster_config/app/create.sh
    
7 - Get the ip of the service

    bash development_tools/cluster_config/get_pods_and_services.sh

8 - Browse the app on the ip from the previous step
    
9 - Test scale the app up

    bash development_tools/cluster_config/app/scale-up.sh
    
10 - Test rolling update

* Make some changes on the code, example change the displaying image from image.png to image2.png 
on the display template.

before: framework/app/Resources/views/default/display.twig.html

    {% image '@AppBundle/Resources/public/images/image.png' %}
    
after: framework/app/Resources/views/default/display.twig.html

    {% image '@AppBundle/Resources/public/images/image2.png' %}
    
* Build a new image the same command on step #4

        bash development_tools/cluster_config/app/build-image.sh
    
* Roll the update

        bash development_tools/cluster_config/rolling_release.sh
        
11 - Test scale down

    bash development_tools/cluster_config/app/scale-down.sh
    
12 - Destroy the environment

    bash development_tools/cluster_config/app/delete.sh
    
13 - Destroy k8s cluster

    docker ps -a | awk '{print $1}' | xargs docker kill
    
