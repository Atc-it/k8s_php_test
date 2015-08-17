#!/usr/bin/env bash

cd ../../..
docker build --tag=k8s_php_dev .
cd development_tools/cluster_config/app/