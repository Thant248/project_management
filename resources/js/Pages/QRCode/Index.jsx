import React from 'react';
import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Index({ auth, users }) {
  return (
    <AuthenticatedLayout
      user={auth.user}
      header={
        <div className="flex justify-between items-center">
          <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Users
          </h2>
        </div>
      }
    >
      <Head title="Users Data" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-gray-900 dark:text-gray-100">
              <div className="overflow-auto">
                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                    <tr>
                      <th className="px-3 py-3">ID</th>
                      <th className="px-3 py-3">Name</th>
                      <th className="px-3 py-3">Email</th>
                      <th className="px-3 py-3">Name QR Code</th>
                      <th className="px-3 py-3">Email QR Code</th>
                      <th className='px-3 py-3'>Name And Email Code</th>
                    </tr>
                  </thead>
                  <tbody>
                    {users.map((user) => (
                      <tr
                        key={user.id}
                        className="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                      >
                        <td className="px-3 py-2">{user.id}</td>
                        <td className="px-3 py-2">{user.name}</td>
                        <td className="px-3 py-2">{user.email}</td>
                        <td className="px-3 py-2">
                          <a 
                          href={user.name_qr} 
                          download={`${user.name}.png`}
                          target='_blank'
                          className="hover:opacity-80 transition-opacity"
                          >
                          <img
                            src={user.name_qr}
                            alt="Name QR Code"
                            className="w-20 h-20"  
                          />
                          </a>
                        </td>
                        <td className="px-3 py-2">
                          <a 
                          href={user.email_qr} 
                          download={`${user.email}.png`}
                          target='__blank'
                          className="hover:opacity-80 transition-opacity"
                          >
                          <img
                            src={user.email_qr}
                            alt="Email QR Code"
                            className="w-20 h-20"
                          />
                          </a>
                        </td>
                        <td className='px-8 py-4'>
                          <a href={user.name_email_qr}
                          download={`${Date.now()}.png`}
                          target='__blank'
                          className='hover:opacity-80 transition-opacity'
                          >
                          <img src={user.name_email_qr} 
                          alt="Name Email QR Code" 
                          className='w-20 h-20'
                          />
                          </a>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
