pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh 'echo no test now'
      }
    }
    stage('build') {
      steps {
        sh 'sudo docker build . -t wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api'
      }
    }
    stage('push') {
      steps {
        sh 'sudo docker push registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker push registry.wip.camp/wip-api'
      }
    }
    stage('clean') {
      steps {
        sh 'sudo docker image rm registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker image rm registry.wip.camp/wip-api'
      }
    }
    stage('deploy-development') {
      steps {
        sh 'sudo kubectl rolling-update wip-api-development --image registry.wip.camp/wip-api:$BUILD_NUMBER --container wip-api-app'
      }
    }
    stage('deploy-staging') {
      steps {
        timeout(time: 7, unit: 'DAYS') {
          input 'Deploy to Staging ?'
        }
      }
    }
    stage('deploy-production') {
      steps {
        timeout(time: 7, unit: 'DAYS') {
          input 'Deploy to Production ?'
        }
      }
    }
  }
  post {
    success {
      sh 'echo success'
    }
    failure {
      sh 'echo failure'
    }
  }
}